<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategorieController extends BaseController
{
    public function get_categories(Request $request)
    {

        try {
            Log::info('Get Categories vehicules  Endpoint Entered.');

            Log::debug('Get Categories Endpoint - All Params: ' . json_encode($request->all()));

            $data['categories'] = Category::all();

            Log::debug('Get Categories Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($data, "Categories vehicules retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get Categories Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get Categories Endpoint Exited.');
        }
    }

    public function add_category(Request $request)
    {

        try {
            Log::info('Add Categories vehicules  Endpoint Entered.');

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

            $category = Category::create([
                'name' => $datas['name'],
                'description' => $datas['description'] ?? NULL,
                'active' => 1
            ]);

            $data['category'] = $category;

            Log::debug('Add Categorie Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Add Categorie successfully");
        } catch (Exception $e) {
            Log::error('Add Categories Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Add Categories Endpoint Exited.');
        }
    }

    public function edit_category(Request $request)
    {
        try {
            Log::info('Edit Categories vehicules  Endpoint Entered.');

            Log::debug('Edit Categories Endpoint - All Params: ' . json_encode($request->all()));
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


            $category = Category::find($data['id']);

            if ($category == null) {
                return $this->sendError("Category not found");
            }

            $category->update($data);
            Log::debug('Edit Categorie Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Edit Categorie successfully");
        } catch (Exception $e) {
            Log::error('Edit Categories Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Edit Categories Endpoint Exited.');
        }
    }

    public function delete_category(Request $request)
    {
        try {
            Log::info('Delete Categories vehicules  Endpoint Entered.');

            Log::debug('Delete Categories Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id' => ['required', 'integer']
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $category = Category::find($data['id']);

            if ($category == null) {
                return $this->sendError("Category not found");
            }

            $category->delete();
            Log::debug('Delete Categorie Endpoint - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Delete Categorie successfully");
        } catch (Exception $e) {
            Log::error('Delete Categories Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete Categories Endpoint Exited.');
        }
    }
}
