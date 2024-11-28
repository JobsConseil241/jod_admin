<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\V1\BaseController;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RoleController extends BaseController
{
    //
    /**
     * @OA\Get(
     *     path="/api/v1/get_roles",
     *     summary="Get All Roles",
     *      tags={"Role"},
     *     description="Get All Roles",
     *     @OA\Parameter(
     *         name="role_id",
     *         in="query",
     *         required=false,
     *         description="Role id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="user_type_id",
     *         in="query",
     *         required=false,
     *         description="Filter by user_type_id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=false,
     *         description="Filter by name",
     *         @OA\Schema(type="string")
     *     ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="success", type="bool"),
     *         @OA\Property(property="code", type="string"),
     *         @OA\Property(
     *             property="data",
     *             type="object",
     *             @OA\Property(property="count", type="integer"),
     *             @OA\Property(
     *                 property="roles",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="role",
     *                         type="object",
     *                         ref="#/components/schemas/Role"
     *                     )
     *                 )
     *             )
     *         ),
     *         @OA\Property(property="message", type="string"),
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         ref="#/components/responses/Requestfails"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         ref="#/components/responses/TokenIvalid"
     *     ),
     *     @OA\Response(
     *         response=202,
     *         ref="#/components/responses/ApplicationUnknown"
     *     ),
     * )
     */

    public function get_roles(Request $request)
    {

        try {
            Log::info('Get roles member Endpoint Entered.');

            Log::debug('Get roles Endpoint - All Params: ' . json_encode($request->all()));
            $roles = Role::with('userType', 'privileges', 'users')->select('*');

            $roles->where('deleted', NULL);

            if ($request->has('role_id') && $request->role_id != null) {
                $roles->where('id', $request->role_id);
            }
            if ($request->has('user_type_id') && $request->user_type_id != null) {
                $roles->where('user_type_id', $request->user_type_id);
            }
            if ($request->has('name') && $request->name != null) {
                $roles->where('name', 'like', '%' . $request->name . '%');
            }

            $data['count'] = $roles->count();
            $data['roles'] = $roles->get();
            Log::debug('Get roles Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "roles retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get roles Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get roles Endpoint Exited.');
        }
    }

    //
    /**
     * @OA\Post(
     *     path="/api/v1/add_role",
     *     security={{"bearerAuth":{}}},
     *     summary="Add Role",
     *     description="Add Role",
     *      tags={"Role"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"name","description","user_type_id"},
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="description", type="string"),
     *              @OA\Property(property="user_type_id", type="integer"),
     *              )
     *          )
     *      ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="success", type="bool"),
     *         @OA\Property(property="code", type="string"),
     *         @OA\Property(
     *             property="data",
     *             type="object",
     *                     @OA\Property(
     *                         property="role",
     *                         type="object",
     *                         ref="#/components/schemas/Role"
     *                     )
     *         ),
     *         @OA\Property(property="message", type="string"),
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         ref="#/components/responses/Requestfails"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         ref="#/components/responses/TokenIvalid"
     *     ),
     *     @OA\Response(
     *         response=202,
     *         ref="#/components/responses/ApplicationUnknown"
     *     ),
     * )
     */

    public function add_role(Request $request)
    {
        try {
            Log::info('Add roles member Endpoint Entered.');

            Log::debug('Add roles Endpoint - All Params: ' . json_encode($request->all()));
            $rules = [
                'name' => ['required', 'string', 'unique:roles'],
                'description' => ['required', 'string'],
                'user_type_id' => ['required', 'exists:user_types,id'],
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $update_data = $request->all();
            $role = Role::create($update_data);
            $data['role'] = $role;

            Log::debug('Add roles Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Role created successfully");
        } catch (Exception $e) {
            Log::error('Add roles Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Add roles Endpoint Exited.');
        }
    }

    //
    /**
     * @OA\Post(
     *     path="/api/v1/update_role",
     *     security={{"bearerAuth":{}}},
     *     summary="Update Role",
     *     description="Update Role",
     *      tags={"Role"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"id"},
     *              @OA\Property(property="id", type="integer"),
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="description", type="string"),
     *              @OA\Property(property="user_type_id", type="integer"),
     *              )
     *          )
     *      ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="success", type="bool"),
     *         @OA\Property(property="code", type="string"),
     *         @OA\Property(
     *             property="data",
     *             type="object",
     *                     @OA\Property(
     *                         property="role",
     *                         type="object",
     *                         ref="#/components/schemas/Role"
     *                     )
     *         ),
     *         @OA\Property(property="message", type="string"),
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         ref="#/components/responses/Requestfails"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         ref="#/components/responses/TokenIvalid"
     *     ),
     *     @OA\Response(
     *         response=202,
     *         ref="#/components/responses/ApplicationUnknown"
     *     ),
     * )
     */

    public function update_role(Request $request)
    {
        try {
            Log::info('Update roles member Endpoint Entered.');

            Log::debug('Update roles Endpoint - All Params: ' . json_encode($request->all()));
            $rules = [
                'id' => ['required', 'exists:roles,id,deleted,NULL'],
            ];
            if ($request->has('name') && $request->name != null) {
                $rules['name'] = ['required', 'unique:roles,name,' . $request->id];
            }
            if ($request->has('user_type_id') && $request->user_type_id != null) {
                $rules['user_type_id'] = ['required', 'exists:user_types,id'];
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            $update_data = $request->all();
            unset($update_data['id']);
            Role::find($request->id)->update($update_data);
            $role = Role::with('user_type', 'privileges')->find($request->id);
            $data['role'] = $role;
            Log::debug('Update roles Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Role updated Successfully");
        } catch (Exception $e) {
            Log::error('Update roles Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Update roles Endpoint Exited.');
        }
    }

    //
    /**
     * @OA\Post(
     *     path="/api/v1/delete_role",
     *     security={{"bearerAuth":{}}},
     *     summary="Delete Role",
     *     description="Delete Role",
     *      tags={"Role"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"role_id"},
     *              @OA\Property(property="role_id", type="integer"),
     *              )
     *          )
     *      ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="success", type="bool"),
     *         @OA\Property(property="code", type="string"),
     *         @OA\Property(
     *             property="data",
     *             type="object",
     *                     @OA\Property(
     *                         property="role",
     *                         type="object",
     *                         ref="#/components/schemas/Role"
     *                     )
     *         ),
     *         @OA\Property(property="message", type="string"),
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         ref="#/components/responses/Requestfails"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         ref="#/components/responses/TokenIvalid"
     *     ),
     *     @OA\Response(
     *         response=202,
     *         ref="#/components/responses/ApplicationUnknown"
     *     ),
     * )
     */
    public function delete_role(Request $request)
    {
        try {
            Log::info('Delete roles member Endpoint Entered.');

            Log::debug('Delete roles Endpoint - All Params: ' . json_encode($request->all()));
            $rules = [
                'role_id' => ['required', 'integer', 'exists:roles,id,deleted,NULL'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            Role::find($request->role_id)->update([
                'deleted' => 1,
                'deleted_at' => now()
            ]);
            $role =  Role::with('user_type', 'privileges')->find($request->role_id);
            $data['role'] = $role;
            Log::debug('Delete roles Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Role deleted successfully");
        } catch (Exception $e) {
            Log::error('Delete roles Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete roles Endpoint Exited.');
        }
    }

    //
    /**
     * @OA\Post(
     *     path="/api/v1/assign_role",
     *     security={{"bearerAuth":{}}},
     *     summary="Assign role to user",
     *     description="Assign role to user",
     *      tags={"User"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"user_id","role_id"},
     *              @OA\Property(property="user_id", type="integer"),
     *              @OA\Property(property="role_id", type="integer"),
     *              )
     *          )
     *      ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="success", type="bool"),
     *         @OA\Property(property="code", type="string"),
     *         @OA\Property(
     *             property="data",
     *             type="object",
     *                     @OA\Property(
     *                         property="user",
     *                         type="object",
     *                         ref="#/components/schemas/User"
     *                     )
     *         ),
     *         @OA\Property(property="message", type="string"),
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         ref="#/components/responses/Requestfails"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         ref="#/components/responses/TokenIvalid"
     *     ),
     *     @OA\Response(
     *         response=202,
     *         ref="#/components/responses/ApplicationUnknown"
     *     ),
     * )
     */
    public function assign_role(Request $request)
    {
        try {
            Log::info('Assign role Endpoint Entered.');

            Log::debug('Assign role Endpoint - All Params: ' . json_encode($request->all()));
            $rules = [
                'user_id' => ['required', 'integer', 'exists:users,id,deleted,NULL'],
                'role_id' => ['required', 'integer', 'exists:roles,id,deleted,NULL', Rule::unique('user_roles')->where('user_id', $request->user_id)],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            UserRole::create($request->all());
            $data['user'] = User::with('user_type', 'roles', 'roles.privileges', 'provider', 'order_budget_treshold', 'offer_amount_treshold')->find($request->user_id);

            Log::debug('Assign role Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Role updated successfully");
        } catch (Exception $e) {
            Log::error('Assign role Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Assign role Endpoint Exited.');
        }
    }


    //
    /**
     * @OA\Post(
     *     path="/api/v1/remove_role",
     *     security={{"bearerAuth":{}}},
     *     summary="remove role to user",
     *     description="remove role to user",
     *      tags={"User"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"user_id","role_id"},
     *              @OA\Property(property="user_id", type="integer"),
     *              @OA\Property(property="role_id", type="integer"),
     *              )
     *          )
     *      ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *         @OA\Property(property="success", type="bool"),
     *         @OA\Property(property="code", type="string"),
     *         @OA\Property(
     *             property="data",
     *             type="object",
     *                     @OA\Property(
     *                         property="user",
     *                         type="object",
     *                         ref="#/components/schemas/User"
     *                     )
     *         ),
     *         @OA\Property(property="message", type="string"),
     *     )
     * ),
     *     @OA\Response(
     *         response=201,
     *         ref="#/components/responses/Requestfails"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         ref="#/components/responses/TokenIvalid"
     *     ),
     *     @OA\Response(
     *         response=202,
     *         ref="#/components/responses/ApplicationUnknown"
     *     ),
     * )
     */
    public function remove_role(Request $request)
    {
        try {
            Log::info('Remove role Endpoint Entered.');

            Log::debug('Remove role Endpoint - All Params: ' . json_encode($request->all()));
            $rules = [
                'user_id' => ['required', 'integer', 'exists:users,id,deleted,NULL'],
                'role_id' => ['required', 'integer', 'exists:roles,id,deleted,NULL', Rule::exists('user_roles')->where('user_id', $request->user_id)],
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            UserRole::where("user_id", $request->user_id)->where("role_id", $request->role_id)->delete();
            $data['user'] = User::with('user_type', 'roles', 'roles.privileges', 'provider', 'order_budget_treshold', 'offer_amount_treshold')->find($request->user_id);

            Log::debug('Remove role Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Role updated successfully");
        } catch (Exception $e) {
            Log::error('Remove role Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Remove role Endpoint Exited.');
        }
    }
}
