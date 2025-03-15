<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    /**
     * Affiche la liste des paiements de l'utilisateur
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $user->load(['payments']);
        return view(
            'payment.list',
            [
                'payments' => $user->payments,
            ]
        );
    }

    /**
     * Crée un nouvel enregistrement de paiement
     *
     * @param string $type Type d'entité (reservation)
     * @param array $data Données du paiement
     * @return bool Résultat de l'opération
     */
    public static function create($type, $data)
    {
        $payment = new Paiement();

        if ($type == 'reservation') {
            $payment->reservation_id = $data['reservation_id'];
        }

        $payment->description = $data['description'];
        $payment->reference = $data['reference'];
        $payment->amount = $data['amount'];
        $payment->status = $data['status'];
        $payment->time_out = $data['time_out'];
        $payment->customer_id = $data['customer_id'];

        return $payment->save();
    }

    /**
     * Initialise un paiement avec eBilling
     *
     * @param string $type Type d'entité (reservation)
     * @param object $data Objet de réservation
     * @return void
     */
    public static function ebilling($type, $data)
    {
        // =============================================================
        // ===================== Setup Attributes =====================
        // =============================================================

        if ($type == 'reservation') {
            // Charger les données associées
            $data->load(['vehicle']);

            // Préparer les informations pour eBilling
            $eb_amount = $data->amount;
            $eb_shortdescription = 'Paiement pour la réservation de véhicule N° ' . $data->reference;
            $eb_reference = $data->reference;
            $eb_email = $data->email;
            $eb_msisdn = $data->phone;
            $eb_callbackurl = url('/callback/ebilling/reservation/' . $data->id);
            $eb_name = $data->firstname . ' ' . $data->lastname;
        } else {
            // Gérer d'autres types si nécessaire
            return redirect()->back()->with('error', 'Type de paiement non pris en charge');
        }

        $expiry_period = 60; // 60 minutes timeout

        // Nom du marchand
        $merchant_name = config('app.name', 'Location de véhicules');

        // =============================================================
        // ============== Invocation du serveur E-Billing ============
        // =============================================================

        // Préparation des données de la facture
        $invoice = [
            'payer_email' => $eb_email,
            'payer_msisdn' => $eb_msisdn,
            'amount' => $eb_amount,
            'short_description' => $eb_shortdescription,
            'external_reference' => $eb_reference,
            'payer_name' => $eb_name,
            'expiry_period' => $expiry_period
        ];

        $e_bills[] = $invoice;

        $global_array = [
            'merchant_name' => $merchant_name,
            'e_bills' => $e_bills,
            'expiry_period' => $expiry_period
        ];

        // Envoi de la requête à eBilling
        $content = json_encode($global_array);
        $curl = curl_init(env('EBILLING_SERVER_URL', 'https://lab.billing-easy.net/api/v1/merchant/e_bills'));
        curl_setopt($curl, CURLOPT_USERPWD, env('EBILLING_USER_NAME', 'TestUsername') . ":" . env('EBILLING_SHARED_KEY', '4test-8f88-xxxxxxxxxxxxxxx'));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
        $json_response = curl_exec($curl);

        // Vérifier le statut de la réponse
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Vérifier si le statut est différent de 200
        if ($status < 200 || $status > 299) {
            Log::error("Erreur eBilling", [
                'status' => $status,
                'response' => $json_response,
                'curl_error' => curl_error($curl),
                'curl_errno' => curl_errno($curl)
            ]);
            die("Erreur: appel à l'URL a échoué avec le statut $status, réponse $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }

        curl_close($curl);

        // Obtenir la réponse au format JSON
        $response = json_decode($json_response, true);

        // Obtenir l'ID unique de transaction
        $bill_id = $response['e_bills'][0]['bill_id'];

        // Enregistrer les informations de paiement
        if ($type == 'reservation') {
            $paymentData = [
                'reservation_id' => $data->id,
                'amount' => $eb_amount,
                'description' => $eb_shortdescription,
                'reference' => $eb_reference,
                'status' => 'PENDING',
                'time_out' => $expiry_period,
                'customer_id' => $data->user_id,
                'description' => $eb_shortdescription,
            ];
        }

        PaymentController::create($type, $paymentData);

        // Mise à jour du statut de la réservation
        $data->payment_status = 'PENDING';
        $data->bill_id = $bill_id;
        $data->save();

        // Redirection vers le portail E-Billing
        echo "<form action='" . env('EBILLING_POST_URL', 'https://lab.billing-easy.net') . "' method='post' name='frm'>";
        echo "<input type='hidden' name='invoice_number' value='" . $bill_id . "'>";
        echo "<input type='hidden' name='eb_callbackurl' value='" . $eb_callbackurl . "'>";
        echo "</form>";
        echo "<script language='JavaScript'>";
        echo "document.frm.submit();";
        echo "</script>";

        exit();
    }

    /**
     * Gère la redirection après paiement eBilling
     *
     * @param string $type Type d'entité (reservation)
     * @param int $entity ID de l'entité
     * @return \Illuminate\Http\Response
     */
    public function callback_ebilling($type, $entity)
    {
        if ($type == 'reservation') {
            $reservation = Location::find($entity);
            $payment = Paiement::where('id', $reservation->paiement_id)->first();

            if ($payment && $payment->status == 'PAID') {
                // Mettre à jour le statut de la réservation
                $reservation->payment_status = 'PAID';
                $reservation->save();

                // Chargement des relations pour la vue
                $reservation->load(['vehicle', 'payment']);

                // Essayer d'envoyer l'email de confirmation
                try {
//                    Mail::to($reservation->email)->queue(new ReservationConfirmation($reservation));
                } catch (Swift_TransportException $e) {
                    Log::error("Erreur d'envoi d'email", ['error' => $e->getMessage()]);
                }

                return view(
                    'payment.success',
                    [
                        'reservation' => $reservation,
                        'payment' => $payment,
                    ]
                )->with('success', 'Votre paiement a bien été reçu. Votre réservation est confirmée.');
            } else {
                // Si le paiement n'est pas encore confirmé, vérifier le statut
                if ($payment && $payment->status == 'PENDING') {
                    return view(
                        'payment.pending',
                        [
                            'reservation' => $reservation,
                            'payment' => $payment,
                        ]
                    )->with('info', 'Votre paiement est en cours de traitement. Veuillez patienter...');
                }

                return redirect('/reservations')->with('error', "Une erreur s'est produite, veuillez réessayer !");
            }
        }

        return redirect('/')->with('error', "Type de paiement non reconnu.");
    }

    /**
     * Reçoit les notifications de paiement de eBilling
     *
     * @return int Code de statut HTTP
     */
    public function notify_ebilling(Request $request)
    {
        Log::info('Notification eBilling reçue', $request->all());

        if ($request->has('reference')) {
            $payment = Payment::where('reference', $request->reference)->first();

            if ($payment) {
                $payment->status = 'PAID';
                $payment->transaction_id = $request->transactionid;
                $payment->operator = $request->paymentsystem;
                $payment->amount = $request->amount;
                $payment->paid_at = now();

                if ($payment->save()) {
                    // Mise à jour du statut de la réservation si elle existe
                    if ($payment->reservation_id) {
                        $reservation = Reservation::find($payment->reservation_id);
                        if ($reservation) {
                            $reservation->payment_status = 'PAID';
                            $reservation->save();

                            // Envoyer une notification par email
                            try {
                                Mail::to($reservation->email)->queue(new ReservationConfirmation($reservation));
                            } catch (\Exception $e) {
                                Log::error("Erreur d'envoi d'email", ['error' => $e->getMessage()]);
                            }
                        }
                    }

                    return response('OK', 200);
                } else {
                    Log::error('Échec de la sauvegarde du paiement', ['payment' => $payment]);
                    return response('Failed to save payment', 500);
                }
            } else {
                Log::error('Référence de paiement non trouvée', ['reference' => $request->reference]);
                return response('Payment reference not found', 404);
            }
        } else {
            Log::error('Requête de notification sans référence', $request->all());
            return response('Missing reference parameter', 400);
        }
    }

    /**
     * Initie un paiement avec USSD Push
     *
     * @param Request $request Requête HTTP
     * @return \Illuminate\Http\JsonResponse
     */
    public function ussd_push(Request $request)
    {
        // Validation des données
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'phone' => 'required|string',
            'operator' => 'required|in:airtelmoney,moovmoney4'
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        // Vérifier si un bill_id existe
        if (!$reservation->bill_id) {
            return response()->json([
                'success' => false,
                'message' => 'Aucune facture n\'a été créée pour cette réservation'
            ], 400);
        }

        // Préparation des données pour le push USSD
        $pushData = [
            'payer_msisdn' => $request->phone,
            'payment_system_name' => $request->operator
        ];

        // Envoi de la requête à eBilling
        $curl = curl_init(env('EBILLING_SERVER_URL', 'https://lab.billing-easy.net/api/v1/merchant/e_bills/') . $reservation->bill_id . '/ussd_push');
        curl_setopt($curl, CURLOPT_USERPWD, env('EBILLING_USER_NAME', 'TestUsername') . ":" . env('EBILLING_SHARED_KEY', '4test-8f88-xxxxxxxxxxxxxxx'));
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($pushData));
        $json_response = curl_exec($curl);

        // Vérifier le statut de la réponse
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status < 200 || $status > 299) {
            Log::error("Erreur eBilling USSD Push", [
                'status' => $status,
                'response' => $json_response,
                'curl_error' => curl_error($curl),
                'curl_errno' => curl_errno($curl)
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Échec de l\'envoi du push USSD'
            ], 500);
        }

        curl_close($curl);

        // Obtenir la réponse au format JSON
        $response = json_decode($json_response, true);

        return response()->json([
            'success' => true,
            'message' => 'Push USSD envoyé avec succès',
            'data' => $response
        ]);
    }

    /**
     * Vérifie le statut d'un paiement
     *
     * @param Request $request Requête HTTP
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_payment_status(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id'
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);
        $payment = Payment::where('reservation_id', $reservation->id)->first();

        return response()->json([
            'success' => true,
            'data' => [
                'reservation' => $reservation,
                'payment' => $payment,
                'status' => $payment ? $payment->status : 'UNKNOWN'
            ]
        ]);
    }

    /**
     * Redirige vers le portail de paiement par carte
     *
     * @param Request $request Requête HTTP
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect_to_card_payment(Request $request)
    {
        $request->validate([
            'reservation_id' => 'required|exists:reservations,id'
        ]);

        $reservation = Reservation::findOrFail($request->reservation_id);

        if (!$reservation->bill_id) {
            return redirect()->back()->with('error', 'Aucune facture n\'a été créée pour cette réservation');
        }

        $redirectUrl = env('EBILLING_LAB_URL', 'https://lab.billing-easy.net') .
            '?invoice=' . $reservation->bill_id .
            '&operator=ORABANK_NG&redirect=' .
            urlencode(url('/callback/ebilling/reservation/' . $reservation->id));

        return redirect($redirectUrl);
    }
}
