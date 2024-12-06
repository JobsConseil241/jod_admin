<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CarController extends BaseController
{
    public function get_Vehicules(Request $request)
    {

        try {
            Log::info('Get Vehicules vehicules member Endpoint Entered.');

            Log::debug('Get Vehicules Endpoint - All Params: ' . json_encode($request->all()));

            $data = Vehicule::all();

            Log::debug('Get Vehicules Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Vehicules vehicules retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get Vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Vehicules Endpoint Exited.');
        }
    }

    public function add_Vehicule(Request $request)
    {

        try {
            Log::info('Add Vehicules vehicules member Endpoint Entered.');

            Log::debug('Add Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'name' => 'required|string|max:255',
                'modele' => 'required|string|max:255',
                'couleur' => 'required|string|max:100',
                'annee' => 'required|integer|min:1900|max:' . date('Y'),
                'immatriculation' => 'required|string|unique:cars,immatriculation|max:20',
                'type_carburant' => 'required|string|in:essence,diesel,hybride,électrique', // Ajustez selon vos types
                'prix_location' => 'required|numeric|min:0',
                'kilometrage' => 'required|integer|min:0',
                'nombre_places' => 'required|integer|min:1|max:50',
                'nombre_portes' => 'required|integer|min:2|max:6',
                'transmission' => 'required|string|in:manuelle,automatique', // Ajustez selon vos types
                'assurance_nom' => 'required|string|max:255',
                'assurance_date_expi' => 'required|date',
                'category_id' => 'required|exists:categories,id', // Vérifie que l'ID existe dans la table `categories`
                'marque_id' => 'required|exists:marques,id', // Vérifie que l'ID existe dans la table `marques`
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $Vehicule = Vehicule::create([
                'name' => $data['name'],
                'modele' => $data['modele'],
                'couleur' => $data['couleur'],
                'annee' => $data['annee'],
                'type_carburant' => $data['type_carburant'],
                'immatriculation' => $data['immatriculation'],
                'prix_location' => $data['prix_location'],
                'kilometrage' => $data['kilometrage'],
                'nombre_places' => $data['nombre_places'],
                'nombre_portes' => $data['nombre_portes'],
                'transmission' => $data['transmission'],
                'assurance_nom' => $data['assurance_nom'],
                'assurance_date_expi' => $data['assurance_date_expi'],
                'category_id' => $data['category_id'],
                'marque_id' => $data['marque_id']
            ]);

            Log::debug('Add Vehicule Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($Vehicule, "Add Vehicule successfully");
        } catch (Exception $e) {
            Log::error('Add Vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Add Vehicules Endpoint Exited.');
        }
    }

    public function edit_Vehicule(Request $request)
    {
        try {
            Log::info('Edit Vehicules vehicules member Endpoint Entered.');

            Log::debug('Edit Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'name' => ['sometimes', 'string'],
                'description' => ['sometimes'],
                'id' => ['required', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $Vehicule = Vehicule::find($data['id']);

            if ($Vehicule == null) {
                return $this->sendError("Vehicule not found");
            }

            $Vehicule->update($data);
            Log::debug('Edit Vehicule Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($Vehicule, "Edit Vehicule successfully");
        } catch (Exception $e) {
            Log::error('Edit Vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Edit Vehicules Endpoint Exited.');
        }
    }

    public function delete_Vehicule(Request $request)
    {
        try {
            Log::info('Delete Vehicules vehicules member Endpoint Entered.');

            Log::debug('Delete Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id' => ['required', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $Vehicule = Vehicule::find($data['id']);

            if ($Vehicule == null) {
                return $this->sendError("Vehicule not found");
            }

            $Vehicule->delete();
            Log::debug('Delete Vehicule Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($Vehicule, "Delete Vehicule successfully");
        } catch (Exception $e) {
            Log::error('Delete Vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete Vehicules Endpoint Exited.');
        }
    }
}
