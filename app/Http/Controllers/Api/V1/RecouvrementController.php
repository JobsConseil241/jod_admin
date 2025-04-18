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
                'montant_recouvre' => ['required', 'integer', 'nullable'],
                'date_recouvrement' => ['required', 'date'],
                'paiement_id' => ['required', 'exists:paiements,id'],
                'id' => ['required', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $category = Recouvrement::find($datas['id']);

            if ($category == null) {
                return $this->sendError("Category Panne not found");
            }

            $paiement = Paiement::find($datas['paiement_id']);
            $paiement->montant_paye = $paiement->montant_paye + $category->montant_recouvre;
            $paiement->montant_restant = $paiement->montant_rest - $category->montant_recouvre;
            $paiement->save();

            $category->montant_recouvre = $datas['montant_recouvre'];
            $category->date_recouvrement = $datas['date_recouvrement'];
            $category->statut = ($category->montant_du == $datas['montant_recouvre']) ? 'recouvre' : 'partiellement_recouvre';
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
