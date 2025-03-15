<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;

class PaymentController extends BaseController
{

    static function ebilling($bank, $type, $data, $try = false, $fees = 0)
    {
        $pay = ControllersPaymentController::check_payment($type, $data->reference);
        $invoice = false;

        if ($pay != null) {
            $invoice = ControllersPaymentController::check_invoice($pay);
        }

        if ($pay != null && $invoice != false) {
            $bill_id = $invoice->billing_id;
        } else {
            // =============================================================
            // ===================== Setup Attributes ===========================
            // =============================================================


            if ($type == 'refill') {
                // Fetch all data (including those not optional) from session

                if ($bank == "orabank") {
                    $eb_name = $data->name_card;
                    $eb_amount = $data->amount_ora + $data->fees_ora + $data->fees_eb;
                    $eb_shortdescription = 'Recharge de la Carte prépayé Orabank **** **** **** ' . substr($data->number_card, -4, 4);
                } elseif ($bank == "uba") {
                    $eb_name = $data->name_account;
                    $eb_amount = $data->amount_uba + $data->fees_eb + env('FEES_UBA_FIX');
                    $eb_shortdescription = 'Recharge de la Carte prépayé UBA ******' . substr($data->number_account, -4, 4);
                }

                $eb_reference = ControllersPaymentController::str_reference(10);
                $eb_email = auth()->user()->email;
                $eb_msisdn = '074808000';
                $eb_callbackurl = url('/callback/ebilling/' . $bank . '/refill/' . $data->id);
            } elseif ($type == 'request') {
                // Fetch all data (including those not optional) from session
                if ($bank == "orabank") {
                    $eb_amount = round((env('PRICE_CARD') + $fees) / 0.98, 0);
                    $eb_shortdescription = 'Frais d\'achat de carte prépayée Orabank.';
                } elseif ($bank == "uba") {
                    $eb_amount = round((env('PRICE_CARD_UBA') + $fees) / 0.98, 0);
                    $eb_shortdescription = 'Frais d\'achat de carte prépayée UBA.';
                } elseif ($bank == "ecobank") {
                    $eb_amount = round((env('PRICE_CARD_ECO') + $fees) / 0.98, 0);
                    $eb_shortdescription = 'Frais d\'achat de carte prépayée Ecobank.';
                }
                $eb_reference = ControllersPaymentController::str_reference(10);
                $eb_email = $data->email;
                $eb_msisdn = '074808000';
                $eb_callbackurl = url('/callback/ebilling/' . $bank . '/request/' . $data->id);
                if ($try) $eb_callbackurl = url('/callback/ebilling/try/' . $bank . '/request/' . $data->id);
                $eb_name = $data->firstname . ' ' . $data->lastname;
            } elseif ($type == 'transfert') {
                $eb_name = Auth::user()->name;
                $eb_amount = $data->amount_net + $data->fees_withdraw + $data->fees_ebilling;
                $eb_shortdescription = 'Transfert de fond  vers ' . $data->operator . ' au numéro ' . $data->phone;
                $eb_reference = ControllersPaymentController::str_reference(10);
                $eb_email = Auth::user()->email;
                $eb_msisdn = '074808000';
                $eb_callbackurl = url('/callback/ebilling/' . $bank . '/transfert/' . $data->id);
            }

            $expiry_period = 60; // 60 minutes timeout

            // Creating invoice for a merchant
            $merchant_name = config('app.name');

            $payment = Payment::where('reference', $eb_reference)->first();

            if ($payment) {
                $eb_reference = ControllersPaymentController::str_reference(10);
            }

            // =============================================================
            // ============== E-Billing server invocation ==================
            // =============================================================

            $global_array =
                [
                    'payer_email' => $eb_email,
                    'payer_msisdn' => $eb_msisdn,
                    'amount' => $eb_amount,
                    'short_description' => $eb_shortdescription,
                    'external_reference' => $eb_reference,
                    'payer_name' => $eb_name,
                    'expiry_period' => $expiry_period
                ];

            if ($type == "transfert") {
                $username =  env('USER_NAME_TR');
                $shared_key = env('SHARED_KEY_TR');
            } else {
                $username =  env('USER_NAME');
                $shared_key = env('SHARED_KEY');
            }

            $content = json_encode($global_array);
            $curl = curl_init(env('SERVER_URL'));
            curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $shared_key);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
            $json_response = curl_exec($curl);

            // Get status code
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            // Check status <> 200
            if ($status < 200  || $status > 299) {
                //die("Error: call to URL failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
                return back()->with('error', "Une erreur $status s'est produite lors du paiement, Veuillez réessayer !")->withInput();
            }

            curl_close($curl);

            // Get response in JSON format
            $response = json_decode($json_response, true);

            // Get unique transaction id
            $bill_id = $response['e_bill']['bill_id'];

            if ($type == 'refill') {
                $data = [
                    'refill' => $data->id,
                    'bank' => $bank,
                    'amount' => $eb_amount,
                    'description' => $eb_shortdescription,
                    'reference' => $eb_reference,
                    'reference_refill' => $data->reference,
                    'status' => STATUT_PENDING,
                    'time_out' => $expiry_period,
                    'customer_id' => Auth::user()->id,
                    'description' => $eb_shortdescription,
                    'billing_id' => $bill_id,
                ];
            } elseif ($type == 'request') {
                $data = [
                    'request' => $data->id,
                    'amount' => $eb_amount,
                    'bank' => $bank,
                    'description' => $eb_shortdescription,
                    'reference' => $eb_reference,
                    'reference_request' => $data->r_reference,
                    'status' => STATUT_PENDING,
                    'time_out' => $expiry_period,
                    'customer_id' => $data->user_id,
                    'description' => $eb_shortdescription,
                    'billing_id' => $bill_id,
                ];
            } elseif ($type == 'transfert') {
                $data = [
                    'amount' => $eb_amount,
                    'bank' => $bank,
                    'description' => $eb_shortdescription,
                    'reference' => $eb_reference,
                    'status' => STATUT_PENDING,
                    'time_out' => $expiry_period,
                    'customer_id' => $data->user_id,
                    'description' => $eb_shortdescription,
                    'billing_id' => $bill_id,
                    'transfert_id' => $data->id,
                ];
            }

            ControllersPaymentController::create($type, $data);
        }

        Log::info('Facture E-Billing id: ' . $bill_id . ' pour ' . Auth::user()->name);

        return $bill_id;
    }

    public function pushUssd(Request $request)
    {

        if ($request->type == "transfert") {
            $auth = env('USER_NAME_TR') . ':' . env('SHARED_KEY_TR');
        } else {
            $auth = env('USER_NAME') . ':' . env('SHARED_KEY');
        }
        $base64 = base64_encode($auth);

        $response = Http::withHeaders([
            "Authorization" => "Basic " . $base64
        ])->post(env('URL_EB') . 'e_bills/' . $request->bill_id . '/ussd_push', [
            "payment_system_name" => $request->payment_system_name,
            "payer_msisdn" => $request->payer_msisdn,
        ]);
        $response = json_decode($response->body());


        if ($response) {
            if ($response->message == "Accepted") {
                $data['message'] = $response->message;
                return $this->sendResponse($data, 'Payée !');
            } else {
                return $this->sendError($response->message, ['error' => 'Failed']);
            }
        } else {
            return $this->sendError("Echec du Push USSD.", ['error' => 'Failed']);
        }
    }

    public function kyc(Request $request)
    {
        $auth = env('USER_NAME') . ':' . env('SHARED_KEY');
        $base64 = base64_encode($auth);

        $url = env('URL_EB') . 'kyc?payment_system_name=' . $request->operator . '&msisdn=' . $request->phone;

        $response = Http::withHeaders([
            "Authorization" => "Basic " . $base64
        ])->get($url);

        $status = $response->status();
        $response = json_decode($response->body());

        if ($status == 200) {
            if (isset($response->key_data)) {
                $data['key_data'] = $response->key_data;
                return $this->sendResponse($data, 'Trouvé !');
            } else {
                return $this->sendError("Echec du KYC.", ['error' => 'Failed']);
            }
        } else {
            return $this->sendError("Echec du KYC.", ['error' => 'Failed']);
        }
    }

    public function callback_ebilling(Request $request)
    {
        $feedback = Feedback::where('customer_id', Auth::user()->id)->orderBy('created_at', 'desc')->first();
        $feed = true;
        if ($feedback) {
            $delais = Controller::delais_month($feedback->created_at);
            if ($delais >= 1) {
                $feed = true;
            } else {
                $feed = false;
            }
        }

        if ($request->type == 'refill') {
            if ($request->bank == "orabank") {
                $refill = Refill::find($request->entity);
            } elseif ($request->bank == "uba") {
                $refill = RefillUba::find($request->entity);
            }
            $payment = Payment::where(['refill_id' => $request->entity, 'bank' => $request->bank, 'status' => STATUT_PAID])->first();
            if ($payment) {
                $refill->load(['payments']);
                $data['refill'] = $refill;
                $data['feed'] = $feed;
                $data['bank'] = $request->bank;

                return $this->sendResponse($data, 'Votre paiment a bien été reçu.');
            } else {
                return $this->sendError("Votre paiement n'a pas été reçu.", ['error' => 'Failed']);
            }
        } elseif ($request->type == 'request') {
            if ($request->bank == "orabank") {
                $request_card = RequestCard::find($request->entity);
            } elseif ($request->bank == "uba") {
                $request_card = RequestCardUba::find($request->entity);
            } elseif ($request->bank == "ecobank") {
                $request_card = RequestCardEcobank::find($request->entity);
            }
            $payment = Payment::where(['request_id' => $request->entity, 'bank' => $request->bank, 'status' => STATUT_PAID])->first();
            if ($payment) {
                $data['request'] = $request_card;
                $data['feed'] = $feed;
                $data['bank'] = $request->bank;

                return $this->sendResponse($data, 'Votre paiment a bien été reçu.');
            } else {
                return $this->sendError("Votre paiement n'a pas été reçu.", ['error' => 'Failed']);
            }
        } elseif ($request->type == 'transfert') {

            $transfert = Transfert::find($request->entity);

            $payment = Payment::where(['transfert_id' => $transfert->id, 'status' => STATUT_PAID])->first();
            if ($payment) {
                $data['transfert'] = $transfert;
                $data['feed'] = $feed;
                $data['bank'] = $request->bank;
                return $this->sendResponse($data, 'Votre paiment a bien été reçu.');
            } else {
                return $this->sendError("Votre paiement n'a pas été reçu.", ['error' => 'Failed']);
            }
        }
    }
}
