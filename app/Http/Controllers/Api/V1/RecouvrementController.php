<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CategoryPanne;
use App\Models\Location;
use App\Models\Paiement;
use App\Models\Recouvrement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RecouvrementController extends BaseController
{
    public function get_all_recouvrements(Request $request)
    {
        try {
            Log::info('Get Recouvrements all data  Endpoint Entered.');

            Log::debug('Get Recouvrements all data Endpoint - All Params: ' . json_encode($request->all()));

            $recou = Recouvrement::with(['location', 'paiement', 'agent'])->orderBy('date_echeance');

            $data['recouvrement'] = $recou->get();

            Log::debug('Get Recouvrements all data Endpoint - Response: ' . json_encode($data));

            return DataTables::of($recou->get())->make(true);
        } catch (Exception $e) {
            Log::error('Get Recouvrements all data Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Recouvrements all data Endpoint Exited.');
        }
    }

    public function edit_recouvrement(Request $request)
    {
        try {
            Log::info('Edit Recouvrement  Endpoint Entered.');

            Log::debug('Edit Recouvrement Endpoint - All Params: ' . json_encode($request->all()));
            $datas = $request->all();
            $rules = [
                'montant_re' => ['required', 'integer', 'nullable'],
                'montant_du' => ['required', 'integer', 'nullable'],
                'id_paiement' => ['required', 'exists:paiements,id'],
                'id_recouvrement' => ['required', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $category = Recouvrement::find($datas['id_recouvrement']);

            if ($category == null) {
                return $this->sendError("Recouvrement Value not found");
            }

            $paie = Paiement::find($datas['id_paiement']);
            Log::info($paie);

            $nouveauMontantPaye = (int)$paie->montant_paye + (int)$datas['montant_re'];
            $nouveauMontantRestant = (int)$paie->montant_restant - (int)$datas['montant_re'];

            $paie->montant_paye = $nouveauMontantPaye;
            $paie->montant_restant = $nouveauMontantRestant;
            $paie->save();

            $category->montant_recouvre = (int)$datas['montant_re'];
            $category->montant_old = (int)$datas['montant_du'];
            $category->montant_du = $nouveauMontantRestant;
            $category->date_recouvrement = date('Y-m-d H:i:s');
            $category->statut = ($category->montant_du == $datas['montant_re']) ? 'recouvre' : 'partiellement_recouvre';
            $data = $category->save();


            Log::debug('Edit Recouvrement Endpoint - Response: ' . json_encode($datas));

            return $this->sendResponse($data, "Edit Recouvrement successfully");
        } catch (Exception $e) {
            Log::error('Edit Recouvremment Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Edit Recouvrement Endpoint Exited.');
        }
    }
}
