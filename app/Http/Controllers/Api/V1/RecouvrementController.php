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

            $paiement = Paiement::find($datas['id_paiement']);
            $paiement->montant_paye = $paiement->montant_paye + $category->montant_re;
            $paiement->montant_restant = $paiement->montant_rest - $category->montant_re;
            $paiement->save();

            $category->montant_recouvre = $datas['montant_re'];
            $category->date_recouvrement = date('Y-m-d H:i:s');
            $category->statut = ($category->montant_du == $datas['montant_re']) ? 'recouvre' : 'partiellement_recouvre';
            $data = $category->save();


            Log::debug('Edit Recouvrement Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Edit Recouvrement successfully");
        } catch (Exception $e) {
            Log::error('Edit Recouvremment Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Edit Recouvrement Endpoint Exited.');
        }
    }
}
