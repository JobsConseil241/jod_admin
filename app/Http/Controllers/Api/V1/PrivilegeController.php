<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Privilege;
use App\Models\Role;
use App\Models\RolePrivilege;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PrivilegeController extends BaseController
{


    //
    /**
     * @OA\Get(
     *     path="/api/v1/get_privilege",
     *     summary="Get Privilege",
     *      tags={"Privilege"},
     *     description="Get Privilege",
     *     @OA\Parameter(
     *         name="privilege_id",
     *         in="query",
     *         required=false,
     *         description="Filter by privilege_id",
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
     *                 property="privileges",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="privilege",
     *                         type="object",
     *                         ref="#/components/schemas/Privilege"
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
    public function get_privilege(Request $request)
    {
        try {
            Log::info('Get privilege Endpoint Entered.');

            Log::debug('Get privilege Endpoint - All Params: ' . json_encode($request->all()));
            $privileges = Privilege::with('user_type')->select("*");

            if ($request->has('privilege_id') && $request->privilege_id != null) {
                $privileges->where('id', $request->privilege_id);
            }
            if ($request->has('user_type_id') && $request->user_type_id != null) {
                $privileges->where('user_type_id', $request->user_type_id);
            }
            if ($request->has('name') && $request->name != null) {
                $privileges->where('name', 'like', '%' . $request->name . '%');
            }
            $data['count'] = $privileges->count();
            $data['privileges'] = $privileges->get();
            Log::debug('Get privilege Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Privileges retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get privilege Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get privilege Endpoint Exited.');
        }
    }

    //
    /**
     * @OA\Post(
     *     path="/api/v1/assign_privilege",
     *     security={{"bearerAuth":{}}},
     *     summary="Assign privilege to roles",
     *     description="Assign privilege to role",
     *      tags={"Role"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"privilege_id","role_id","user_type_id"},
     *              @OA\Property(property="privilege_id", type="integer"),
     *              @OA\Property(property="role_id", type="integer"),
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
    public function assign_privilege(Request $request)
    {
        try {
            Log::info('Assign privilege member Endpoint Entered.');

            Log::debug('Assign privilege Endpoint - All Params: ' . json_encode($request->all()));
            $rules = [
                'role_id' => ['required', 'integer', 'exists:roles,id,deleted,NULL'],
                'privilege_id' => ['required', 'integer', 'exists:privileges,id', Rule::unique('role_privileges')->where('role_id', $request->role_id)],
                'user_type_id' => ['required', 'integer', 'exists:user_types,id']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            RolePrivilege::create($request->all());
            $role =  Role::with('user_type', 'privileges')->find($request->role_id);
            $data['role'] = $role;
            Log::debug('Assign privilege Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Role updated successfully");
        } catch (Exception $e) {
            Log::error('Assign privilege Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Assign privilege Endpoint Exited.');
        }
    }


    //
    /**
     * @OA\Post(
     *     path="/api/v1/remove_privilege",
     *     security={{"bearerAuth":{}}},
     *     summary="Remove privilege to role",
     *     description="Remove privilege to role",
     *      tags={"Role"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"privilege_id","role_id"},
     *              @OA\Property(property="privilege_id", type="integer"),
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
    public function remove_privilege(Request $request)
    {
        try {
            Log::info('Remove roles member Endpoint Entered.');

            Log::debug('Remove roles Endpoint - All Params: ' . json_encode($request->all()));
            $rules = [
                'role_id' => ['required', 'integer', 'exists:roles,id,deleted,NULL'],
                'privilege_id' => ['required', 'integer', 'exists:privileges,id,deleted,NULL', Rule::exists('role_privileges')->where('role_id', $request->role_id)],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            RolePrivilege::where('role_id', $request->role_id)->where('privilege_id', $request->privilege_id)->delete();
            $role =  Role::with('user_type', 'privileges')->find($request->role_id);
            $data['role'] = $role;
            Log::debug('Remove roles Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Role updated successfully");
        } catch (Exception $e) {
            Log::error('Remove roles Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Remove roles Endpoint Exited.');
        }
    }


    //
    /**
     * @OA\Post(
     *     path="/api/v1/clear_privilege",
     *     security={{"bearerAuth":{}}},
     *     summary="Clear all privilege for this role",
     *     description="Clear all privilege for this role",
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
    public function clear_privilege(Request $request)
    {
        try {
            Log::info('Clear privilege member Endpoint Entered.');

            Log::debug('Clear privilege Endpoint - All Params: ' . json_encode($request->all()));
            $rules = [
                'role_id' => ['required', 'integer', 'exists:roles,id,deleted,NULL'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            RolePrivilege::where('role_id', $request->role_id)->delete();
            $role =  Role::with('user_type', 'privileges')->find($request->role_id);
            $data['role'] = $role;
            Log::debug('Clear privilege Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Role cleared successfully");
        } catch (Exception $e) {
            Log::error('Clear privilege Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Clear privilege Endpoint Exited.');
        }
    }
}
