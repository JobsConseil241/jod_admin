<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\CategoryPanne;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CategoriePanneController extends BaseController
{

    public function get_categories_pannes(Request $request)
    {

        try {
            Log::info('Get Categories pannes  Endpoint Entered.');

            Log::debug('Get Categories Endpoint - All Params: ' . json_encode($request->all()));

            $data['categories'] = CategoryPanne::all();

            Log::debug('Get Categories Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Categories pannes retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get Categories Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Categories Endpoint Exited.');
        }
    }

    public function add_category_pannes(Request $request)
    {

        try {
            Log::info('Add Categories pannes  Endpoint Entered.');

            Log::debug('Add Categories Endpoint - All Params: ' . json_encode($request->all()));
            $datas = $request->all();
            $rules = [
                'name' => ['required', 'string']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $category = CategoryPanne::create([
                'name' => $datas['name'],
                'description' => $datas['description'] ?? NULL,
                'active' => 1
            ]);

            $data['category'] = $category;

            Log::debug('Add Categorie Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Add Categorie Panne successfully");
        } catch (Exception $e) {
            Log::error('Add Categories Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Add Categories Endpoint Exited.');
        }
    }

    public function edit_category_pannes(Request $request)
    {
        try {
            Log::info('Edit Categories pannes  Endpoint Entered.');

            Log::debug('Edit Categories Panne Endpoint - All Params: ' . json_encode($request->all()));
            $datas = $request->all();
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


            $category = CategoryPanne::find($datas['id']);

            if ($category == null) {
                return $this->sendError("Category Panne not found");
            }

            $data = $category->update($datas);
            Log::debug('Edit Categorie Panne Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Edit Categorie successfully");
        } catch (Exception $e) {
            Log::error('Edit Categories Panne Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Edit Categories Panne Endpoint Exited.');
        }
    }

    public function delete_category_pannes(Request $request)
    {
        try {
            Log::info('Delete Categories pannes  Endpoint Entered.');

            Log::debug('Delete Categories Endpoint - All Params: ' . json_encode($request->all()));
            $datas = $request->all();
            $rules = [
                'id' => ['required', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $category = CategoryPanne::find($datas['id']);

            if ($category == null) {
                return $this->sendError("Category not found");
            }

            $data = $category->delete();
            Log::debug('Delete Categorie Panne Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Delete Categorie Panne successfully");
        } catch (Exception $e) {
            Log::error('Delete Categories Panne Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete Categories Panne Endpoint Exited.');
        }
    }
}
