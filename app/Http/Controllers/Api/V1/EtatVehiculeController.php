<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\EtatVehicule;
use App\Models\Vehicule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EtatVehiculeController extends BaseController
{

    public function get_vehicule_etats(Request $request) {
        try {
            Log::info('Get Vehicule Etats  Endpoint Entered.');

            Log::debug('Get Vehicule Etats Endpoint - All Params: ' . json_encode($request->all()));

            $datas = $request->all();
            $rules = [
                'id_vehicule' => ['required', 'integer']
            ];


            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            // Retrieve the single vehicle with its pannes
            $vehicule = Vehicule::with(['categorie', 'marque', 'etats'])->find($datas['id_vehicule']);

            // Check if the vehicle exists
            if (!$vehicule) {
                Log::warning('Get Single Vehicule Etat Endpoint - Vehicle not found: ' . $datas['id_vehicule']);
                return $this->sendError("Vehicle not found with ID: ".$datas['id_vehicule'], 404);
            }

            $data['vehicule'] = $vehicule;

            Log::debug('Get Single Vehicule Etats Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Single Vehicule Etats retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get Single Vehicule Etats Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Single Vehicule Etats Endpoint Exited.');
        }
    }

    public function add_etat_vehicule(Request $request)
    {
        try {
            Log::info('Add Etat vehicules  Endpoint Entered.');

            Log::debug('Add Etat vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $datas = $request->all();
            $rules = [
                'kilometrage' => ['required', 'integer'],
                'proprete_int' => ['required', 'integer'],
                'propreter_exte' => ['required', 'integer'],
                'carburant' => ['required', 'string'],
                'cle_vehicule' => ['required', 'boolean'],
                'carte_grise' => ['required', 'boolean'],
                'carte_assurance' => ['required', 'boolean'],
                'carte_viste_technique' => ['required', 'boolean'],
                'carte_extincteur' => ['required', 'boolean'],
                'triangle_signalisation' => ['required', 'boolean'],
                'extincteur' => ['required', 'boolean'],
                'trousse_secours' => ['required', 'boolean'],
                'gilet' => ['required', 'boolean'],
                'cric_manivelle' => ['required', 'boolean'],
                'cle_a_roue' => ['required', 'boolean'],
                'cales_metalliques' => ['required', 'boolean'],
                'cle_plate' => ['required', 'boolean'],
                'anneau_remorquage' => ['required', 'boolean'],
                'tournevis' => ['required', 'boolean'],
                'compresseur' => ['required', 'boolean'],
                'roue_secours' => ['required', 'boolean'],
                'date' => ['required', 'date_format:Y-m-d H:i:s'],
                'etat_general' => ['required', 'boolean'],
                'vehicule_id' => ['required', 'integer', 'exists:vehicules,id']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $etatVehicule = EtatVehicule::create([
                'kilometrage' => $datas['kilometrage'],
                'proprete_int' => $datas['proprete_int'],
                'propreter_exte' => $datas['propreter_exte'],
                'carburant' => $datas['carburant'],
                'cle_vehicule' => $datas['cle_vehicule'],
                'carte_grise' => $datas['carte_grise'],
                'carte_assurance' => $datas['carte_assurance'],
                'carte_viste_technique' => $datas['carte_viste_technique'],
                'carte_extincteur' => $datas['carte_extincteur'],
                'triangle_signalisation' => $datas['triangle_signalisation'],
                'extincteur' => $datas['extincteur'],
                'trousse_secours' => $datas['trousse_secours'],
                'gilet' => $datas['gilet'],
                'cric_manivelle' => $datas['cric_manivelle'],
                'cle_a_roue' => $datas['cle_a_roue'],
                'cales_metalliques' => $datas['cales_metalliques'],
                'cle_plate' => $datas['cle_plate'],
                'anneau_remorquage' => $datas['anneau_remorquage'],
                'tournevis' => $datas['tournevis'],
                'compresseur' => $datas['compresseur'],
                'roue_secours' => $datas['roue_secours'],
                'date' => $datas['date'],
                'etat_general' => $datas['etat_general'],
                'vehicule_id' => $datas['vehicule_id'],
            ]);

            $data['Etat Vehicule'] = $etatVehicule;

            Log::debug('Add Categorie Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($etatVehicule, "Add Etat Vehicule successfully");
        } catch (Exception $e) {
            Log::error('Add Etat Vehicule Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Add Etat Vehicule Endpoint Exited.');
        }
    }


    public function edit_etat_vehicule(Request $request)
    {
        try {
            Log::info('Edit Etat vehicules  Endpoint Entered.');

            Log::debug('Edit Etat Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'kilometrage' => ['sometimes', 'integer'],
                'proprete_int' => ['sometimes', 'integer'],
                'propreter_exte' => ['sometimes', 'integer'],
                'carburant' => ['sometimes', 'string'],
                'cle_vehicule' => ['sometimes', 'boolean'],
                'carte_grise' => ['sometimes', 'boolean'],
                'carte_assurance' => ['sometimes', 'boolean'],
                'carte_viste_technique' => ['sometimes', 'boolean'],
                'carte_extincteur' => ['sometimes', 'boolean'],
                'triangle_signalisation' => ['sometimes', 'boolean'],
                'extincteur' => ['sometimes', 'boolean'],
                'trousse_secours' => ['sometimes', 'boolean'],
                'gilet' => ['sometimes', 'boolean'],
                'cric_manivelle' => ['sometimes', 'boolean'],
                'cle_a_roue' => ['sometimes', 'boolean'],
                'cales_metalliques' => ['sometimes', 'boolean'],
                'cle_plate' => ['sometimes', 'boolean'],
                'anneau_remorquage' => ['sometimes', 'boolean'],
                'tournevis' => ['sometimes', 'boolean'],
                'compresseur' => ['sometimes', 'boolean'],
                'roue_secours' => ['sometimes', 'boolean'],
                'date' => ['sometimes', 'date_format:Y-m-d H:i:s'],
                'etat_general' => ['sometimes', 'boolean'],
                'vehicule_id' => ['sometimes', 'integer', 'exists:vehicules,id'],
                'id' => ['sometimes', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $category = EtatVehicule::find($data['id']);

            if ($category == null) {
                return $this->sendError("Etat Vehicule not found");
            }

            $category->update($data);
            Log::debug('Edit Etat vehicule Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Edit Etat Vehicule successfully");
        } catch (Exception $e) {
            Log::error('Edit Etat vehicule Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Edit Etat vehicules Endpoint Exited.');
        }
    }

    public function delete_etat_vehicule(Request $request)
    {
        try {
            Log::info('Delete Etat vehicules  Endpoint Entered.');

            Log::debug('Delete Etat vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id' => ['required', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $category = EtatVehicule::find($data['id']);

            if ($category == null) {
                return $this->sendError("Etat vehicules not found");
            }

            $category->delete();
            Log::debug('Delete Etat vehicules Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Delete Etat vehicules successfully");
        } catch (Exception $e) {
            Log::error('Delete Etat vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete Etat vehicules Endpoint Exited.');
        }
    }
}
