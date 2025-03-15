<?php

namespace App\Services;

class EbillingService
{
    static function str_reference($length)
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    static function upd_transfert(Transfert $transfert, Payment $payment)
    {
        $admins = User::where('security_role_id', '<=', 2)->get();
        $transfert->status = STATUT_PAID;
        $transfert->updated_at = date('Y-m-d H:i');
        $transfert->created_at = date('Y-m-d H:i');
        $transfert->save();
        $transfert->load(['user']);
        $status = Controller::status($transfert->status);
        Log::info('Status du transfert  id: ' . $transfert->id . ' mis à jour  à  ' . $status['message']);
        Mail::to($transfert->user->email)->queue(new NotificationPaidMessage($transfert));
        $data['title'] = "Commande de Carte Prépayée";
        $data['body'] = " Merci pour votre confiance en Recharge Visa By Digitech Africa. Votre transfert
                N° " . $transfert->id . "  a été bien traitée avec succès.";
        $transfert->user->notify(new RequestPay($payment));
        if ($payment->operator == "ORABANK_NG" && $payment->amount > 400000) {
            Mail::to($transfert->user->email)->queue(new NotificationTransfertMessage($transfert));
        }
        if ($payment->operator == "ORABANK_NG") Mail::to('joycianye.ngondo@digitech-africa.com')->cc('vita.obono@digitech-africa.com')->queue(new NotificationMessage($transfert));
        foreach ($admins as $admin) {
            Mail::to('rechargevisa@digitechafrica.freshdesk.com')->queue(new NotificationMessage($transfert));
            $admin->notify(new NewRequest($transfert));
        }
        AuthController::sendNotification($data, $transfert->user);
    }

    static function check_invoice(Payment $payment)
    {
        $auth = env('USER_NAME') . ':' . env('SHARED_KEY');
        $base64 = base64_encode($auth);

        $response = Http::withHeaders([
            "Authorization" => "Basic " . $base64
        ])->get(env('SERVER_URL') . $payment->bill_id);

        $response = json_decode($response->body());


        if ($response != null && $response->state == 'ready') {
            return $response;
        } else {
            return false;
        }
    }

    static function check_payment($type, $reference)
    {
        if ($type == 'refill') {
            $payment = Payment::where('reference_refill', $reference)->get();
        } else {
            $payment = Payment::where('reference_request', $reference)->get();
        }

        if ($payment->first() != null) {
            return $payment->first();
        } else {
            return null;
        }
    }

    private function checkAndNotifyBalance($access_token, $transfert)
    {
        $response_balance = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token,
        ])->get(env('SHAP_URL') . 'balance');

        if ($response_balance->status() == 200) {
            foreach (json_decode($response_balance->body())->data as $operator) {
                if ($operator->payment_system_name == $transfert->operator && $operator->category == "PAYOUT") {
                    $solde = $operator->amount;
                    $op = ($operator->payment_system_name == "airtelmoney") ? env('SOLDE_AM_CHECK') : env('SOLDE_MM_CHECK');

                    if ($solde <= 1000000 && $op) {
                        $this->sendLowBalanceNotification($operator);
                        $this->toggleEnvCheckFlag($operator->payment_system_name, false);
                    } elseif ($solde > 500000 && !$op) {
                        $this->toggleEnvCheckFlag($operator->payment_system_name, true);
                    }
                }
            }
        }
    }

    private function sendLowBalanceNotification($operator)
    {
        Mail::to('joycianye.ngondo@digitech-africa.com')
            ->cc(['guillaume.ondeno@digitech-africa.com', 'charles.boukinda@digitech-africa.com', 'richard.mebodo@digitech-africa.com'])
            ->queue(new SoldeMessage($operator));
    }

    private function toggleEnvCheckFlag($payment_system_name, $status)
    {
        if ($payment_system_name == 'airtelmoney') {
            Controller::envUpdate('SOLDE_AM_CHECK', $status);
        } else {
            Controller::envUpdate('SOLDE_MM_CHECK', $status);
        }
    }

    private function makePayout($access_token, $transfert, $payment)
    {
        return Http::withHeaders([
            "Authorization" => "Bearer " . $access_token,
        ])->post(env('SHAP_URL') . 'payout', [
            "payment_system_name" => $transfert->operator,
            "payout" => [
                "payee_msisdn" => $transfert->phone,
                "amount" => $transfert->amount_net + $transfert->fees_withdraw,
                "external_reference" => $payment->billing_id ?? $this->str_random(6),
                "payout_type" => "withdrawal",
            ],
        ]);
    }

    private function storePayoutAndUpdateTransfert($response_body, $transfert, $payment)
    {
        $payout = new Payout();

        $payout->external_reference = $response_body->response->external_reference;
        $payout->payment_system_name = $response_body->response->payment_system_name;
        $payout->payee_msisdn = $transfert->phone;
        $payout->amount = $response_body->response->amount;
        $payout->payout_type = "withdrawal";
        $payout->payout_id = $response_body->response->payout_id;
        $payout->transaction_id = $response_body->response->transaction_id;
        $payout->message = $response_body->success_message;
        $payout->status = STATUT_DO;
        $payout->user_id = $transfert->user_id;
        $payout->transfert_id = $transfert->id;

        if ($payout->save()) {
            $transfert->status = STATUT_DO;
            $transfert->updated_at = now();
            $transfert->created_at = now();
            $transfert->save();

            $this->notifyUserAndAdmins($transfert, $payment);
        } else {
            PaymentController::upd_transfert($transfert, $payment);
        }
    }

    private function notifyUserAndAdmins($transfert, $payment)
    {
        $transfert->load(['user']);
        $status = Controller::status($transfert->status);
        Log::info('Status du transfert id: ' . $transfert->id . ' mis à jour à ' . $status['message']);

        Mail::to($transfert->user->email)->queue(new NotificationPaidMessage($transfert));

        $data = [
            'title' => "Commande de Carte Prépayée",
            'body' => "Merci pour votre confiance en Recharge Visa By Digitech Africa. Votre transfert N° " . $transfert->id . " a été bien traité avec succès."
        ];

        $transfert->user->notify(new TransfertPay($payment));
        $admins = User::where('security_role_id', '<=', 2)->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewTransfert($transfert));
        }

        AuthController::sendNotification($data, $transfert->user);
    }
}
