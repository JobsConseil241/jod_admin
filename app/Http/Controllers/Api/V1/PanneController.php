<?php

namespace App\Http\Controllers\Api\v1;

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

            $data['pannes'] = Panne::all();

            Log::debug('Get Pannes Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Pannes retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get Pannes Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Pannes Endpoint Exited.');
        }
    }

    public function get_all_vehicules_pannes(Request $request)
    {

        try {
            Log::info('Get Vehicules Pannes  Endpoint Entered.');

            Log::debug('Get Vehicules Pannes Endpoint - All Params: ' . json_encode($request->all()));

            $data['vehicules'] = Vehicule::has('pannes')->with(['pannes' => function($query) {
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

            $category = Panne::create([
                'name' => $datas['name'],
                'description' => $datas['description'] ?? NULL,
                'category_panne_id' => $datas['category_panne_id'],
            ]);

            $data['panne'] = $category;

            Log::debug('Add Panne Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Add Panne successfully");
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
            $data = $request->all();
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


            $category = Panne::find($data['id']);

            if ($category == null) {
                return $this->sendError("Panne not found");
            }

            $category->update($data);
            Log::debug('Edit Panne Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Edit Panne successfully");
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
            $data = $request->all();
            $rules = [
                'id_panne' => ['required', 'integer']
            ];


            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $category = Panne::find($data['id_panne']);

            if ($category == null) {
                return $this->sendError("Panne not found");
            }

            $category->delete();
            Log::debug('Delete Panne Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Delete Panne successfully");
        } catch (Exception $e) {
            Log::error('Delete Panne Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete Panne Endpoint Exited.');
        }
    }

    public function assign_pannes_vehicules(Request $request) {
        try {
            Log::info('Assign Pannes to Vehicules Endpoint Entered.');

            Log::debug('Assign Pannes to Vehicules Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id_vehicule' => ['required', 'integer'],
                'ids_pannes' => ['required', 'array'],
                'ids_pannes.*' => ['integer', 'exists:pannes,id'],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $category = Vehicule::find($data['id_vehicule']);

            if ($category == null) {
                return $this->sendError("Vehicule not found");
            }

            $category->pannes()->attach($data['ids_pannes']);
            Log::debug('Add pannes to vehicules Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Add Panne successfully");
        } catch (Exception $e) {
            Log::error('Assign Pannes to Vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Assign Pannes to Vehicules Endpoint Exited.');
        }
    }

    public function update_pannes_vehicules(Request $request) {
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


            $category = VehiculePanne::find($data['id_panne']);

            if ($category == null) {
                return $this->sendError("panne associate to vehicule not found");
            }

            $vehiculePanne = VehiculePanne::find($data['id_panne']);
            $vehiculePanne->status = $data['status'] ?? '';
            $vehiculePanne->montant = $data['montant'] ?? '';
            $vehiculePanne->save();

            Log::debug('update state pannes aasociate to vehicules Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Update successfully");
        } catch (Exception $e) {
            Log::error('Update Pannes to Vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Update Pannes to Vehicules Endpoint Exited.');
        }
    }

    public function delete_pannes_vehicules(Request $request) {
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


            $category = VehiculePanne::find($data['id_panne']);

            if ($category == null) {
                return $this->sendError("panne associate to vehicule not found");
            }

            VehiculePanne::find($data['id_panne'])->delete();

            Log::debug('delete pannes aasociate to vehicules Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Delete successfully");
        } catch (Exception $e) {
            Log::error('Delete Panne to Vehicules Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete Panne to Vehicule Endpoint Exited.');
        }
    }
}
