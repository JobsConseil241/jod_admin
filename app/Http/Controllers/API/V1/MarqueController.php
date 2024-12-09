<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\API\V1\BaseController;
use App\Models\Category;
use App\Models\Marque;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MarqueController extends BaseController
{

    public function get_brands(Request $request)
    {

        try {
            Log::info('Get Marques vehicules member Endpoint Entered.');

            Log::debug('Get Marques Endpoint - All Params: ' . json_encode($request->all()));

            $data = Marque::all();

            Log::debug('Get Marques Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Marques vehicules retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get Marques Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Marques Endpoint Exited.');
        }
    }

    public function add_brand(Request $request)
    {

        try {
            Log::info('Add Marques vehicules member Endpoint Entered.');

            Log::debug('Add Marques Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'name' => ['required', 'string']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $category = Marque::create([
                'name' => $data['name'],
                'description' => $data['description'] ?? NULL,
                'active' => 1
            ]);

            Log::debug('Add Marque Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Add Marque successfully");
        } catch (Exception $e) {
            Log::error('Add Marques Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Add Marques Endpoint Exited.');
        }
    }

    public function edit_brand(Request $request)
    {
        try {
            Log::info('Edit Marques vehicules member Endpoint Entered.');

            Log::debug('Edit Marques Endpoint - All Params: ' . json_encode($request->all()));
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


            $category = Marque::find($data['id']);

            if ($category == null) {
                return $this->sendError("Category not found");
            }

            $category->update($data);
            Log::debug('Edit Categorie Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Edit Categorie successfully");
        } catch (Exception $e) {
            Log::error('Edit Marques Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Edit Marques Endpoint Exited.');
        }
    }

    public function delete_brand(Request $request)
    {
        try {
            Log::info('Delete Marques vehicules member Endpoint Entered.');

            Log::debug('Delete Marques Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id' => ['required', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $category = Marque::find($data['id']);

            if ($category == null) {
                return $this->sendError("Marque not found");
            }

            $category->delete();

            Log::debug('Delete Categorie Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Delete Categorie successfully");
        } catch (Exception $e) {
            Log::error('Delete Marques Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete Marques Endpoint Exited.');
        }
    }
}
