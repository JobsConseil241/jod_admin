<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Panne;
use App\Models\Vehicule;
use App\Models\VehiculePanne;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PanneController extends BaseController
{
    public function get_all_pannes(Request $request)
    {
        try {
            Log::info('Get Pannes  Endpoint Entered.');

            Log::debug('Get Pannes Endpoint - All Params: ' . json_encode($request->all()));

            $pannes = Panne::with('categorie')->select('pannes.*');

            if ($request->has('id') && $request->id != null) {
                $pannes->where('id', $request->id);
            }

            $data['pannes'] = $pannes->get();

            Log::debug('Get Pannes Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Pannes retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get Pannes Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Pannes Endpoint Exited.');
        }
    }

    public function get_vehicule_pannes(Request $request) {
        try {
            Log::info('Get Vehicule Pannes  Endpoint Entered.');

            Log::debug('Get Vehicule Pannes Endpoint - All Params: ' . json_encode($request->all()));

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
            $vehicule = Vehicule::with(['categorie', 'marque', 'pannes' => function ($query) {
                $query->with('categorie_pannes');
            }])->find($datas['id_vehicule']);

            // Check if the vehicle exists
            if (!$vehicule) {
                Log::warning('Get Single Vehicule Pannes Endpoint - Vehicle not found: ' . $datas['id_vehicule']);
                return $this->sendError("Vehicle not found with ID: ".$datas['id_vehicule'], 404);
            }

            $data['vehicule'] = $vehicule;

            Log::debug('Get Single Vehicule Pannes Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Vehicule Pannes retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get Vehicule Pannes Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Vehicule Pannes Endpoint Exited.');
        }
    }

    public function get_all_vehicules_pannes(Request $request)
    {

        try {
            Log::info('Get Vehicules Pannes  Endpoint Entered.');

            Log::debug('Get Vehicules Pannes Endpoint - All Params: ' . json_encode($request->all()));

            $data['vehicules'] = Vehicule::has('pannes')->with(['pannes' => function ($query) {
                $query->with('categorie_pannes');
            }])->get();

            Log::debug('Get Vehicules Pannes Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Vehicules Pannes retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get Vehicules Pannes Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Vehicules Pannes Endpoint Exited.');
        }
    }

    public function add_pannes(Request $request)
    {

        try {
            Log::info('Add Panne Endpoint Entered.');

            Log::debug('Add Pannes Endpoint - All Params: ' . json_encode($request->all()));
            $datas = $request->all();
            $rules = [
                'name' => ['required', 'string'],
                'category_panne_id' => ['required', 'integer', 'exists:category_pannes,id'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $panne = Panne::create([
                'name' => $datas['name'],
                'description' => $datas['description'] ?? NULL,
                'category_panne_id' => $datas['category_panne_id'],
            ]);

            $data['panne'] = $panne;

            Log::debug('Add Panne Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Add Panne successfully");
        } catch (Exception $e) {
            Log::error('Add Panne Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Add Panne Endpoint Exited.');
        }
    }

    public function edit_pannes(Request $request)
    {
        try {
            Log::info('Edit Pannes  Endpoint Entered.');

            Log::debug('Edit Panne Endpoint - All Params: ' . json_encode($request->all()));
            $datas = $request->all();
            $rules = [
                'name' => ['sometimes', 'string'],
                'description' => ['sometimes'],
                'category_panne_id' => ['sometimes', 'integer', 'exists:category_pannes,id'],
                'id' => ['required', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $panne = Panne::find($datas['id']);

            if ($panne == null) {
                return $this->sendError("Panne not found");
            }

            $data = $panne->update($datas);
            Log::debug('Edit Panne Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Edit Panne successfully");
        } catch (Exception $e) {
            Log::error('Edit Panne Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Edit Panne Endpoint Exited.');
        }
    }

    public function delete_pannes(Request $request)
    {
        try {
            Log::info('Delete Pannes  Endpoint Entered.');

            Log::debug('Delete Pannes Endpoint - All Params: ' . json_encode($request->all()));
            $datas = $request->all();
            $rules = [
                'id_panne' => ['required', 'integer']
            ];


            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $panne = Panne::find($datas['id_panne']);

            if ($panne == null) {
                return $this->sendError("Panne not found");
            }

            $data = $panne->delete();

            Log::debug('Delete Panne Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Delete Panne successfully");
        } catch (Exception $e) {
            Log::error('Delete Panne Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete Panne Endpoint Exited.');
        }
    }

    public function assign_pannes_vehicules(Request $request)
    {
        try {
            Log::info('Assign Pannes to Vehicules Endpoint Entered.');

            Log::debug('Assign Pannes to Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id_vehicule' => ['required', 'integer'],
                'ids_pannes' => ['required', 'array'],
                'ids_pannes.*' => ['integer', 'exists:pannes,id'],
                'status' => ['required', 'string'],
                'montant' => ['sometimes', 'integer', 'min:0'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $car = Vehicule::find($data['id_vehicule']);

            if ($car == null) {
                return $this->sendError("Vehicule not found");
            }

            $data = $car->pannes()->attach($data['ids_pannes'], [
                'status' => $data['status'] ?? 'EN COURS',
                'montant' => $data['montant'] ?? 0,
            ]);

            Log::debug('Add pannes to vehicules Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Add Panne successfully");
        } catch (Exception $e) {
            Log::error('Assign Pannes to Vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Assign Pannes to Vehicules Endpoint Exited.');
        }
    }

    public function update_pannes_vehicules(Request $request)
    {
        try {
            Log::info('Update Pannes to Vehicules Endpoint Entered.');

            Log::debug('Assign Pannes to Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id_panne' => ['required', 'integer'],
                'status' => ['sometimes', 'string'],
                'montant' => ['sometimes', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $panne = VehiculePanne::find($data['id_panne']);

            if ($panne == null) {
                return $this->sendError("panne associate to vehicule not found");
            }

            $vehiculePanne = VehiculePanne::find($data['id_panne']);
            $vehiculePanne->status = $data['status'] ?? '';
            $vehiculePanne->montant = $data['montant'] ?? '';
            $data = $vehiculePanne->save();

            Log::debug('update state pannes aasociate to vehicules Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Update successfully");
        } catch (Exception $e) {
            Log::error('Update Pannes to Vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Update Pannes to Vehicules Endpoint Exited.');
        }
    }

    public function delete_pannes_vehicules(Request $request)
    {
        try {
            Log::info('Delete Pannes to Vehicules Endpoint Entered.');

            Log::debug('Delete Pannes to Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id_panne' => ['required', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $panne = VehiculePanne::find($data['id_panne']);

            if ($panne == null) {
                return $this->sendError("panne associate to vehicule not found");
            }

            $data = VehiculePanne::find($data['id_panne'])->delete();

            Log::debug('delete pannes aasociate to vehicules Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Delete successfully");
        } catch (Exception $e) {
            Log::error('Delete Panne to Vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete Panne to Vehicule Endpoint Exited.');
        }
    }
}
