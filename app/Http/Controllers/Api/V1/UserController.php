<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseController;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserController extends BaseController
{
    //
    /**
     * @OA\Get(
     *     path="/api/v1/get_users",
     *     summary="Get Users",
     *     security={{"bearerAuth":{}}},
     *      tags={"User"},
     *     description="Get Users",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=false,
     *         description="User id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="user_type_id",
     *         in="query",
     *         required=false,
     *         description="Filter by User type id",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=false,
     *         description="Filter by User name",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         required=false,
     *         description="Filter by User email",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="phone",
     *         in="query",
     *         required=false,
     *         description="Filter by User phone",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         description="Page number default 1",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="records",
     *         in="query",
     *         required=false,
     *         description="Records per page default 20",
     *         @OA\Schema(type="number")
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
     *              @OA\Property(property="page", type="integer"),
     *              @OA\Property(property="records", type="integer"),
     *             @OA\Property(
     *                 property="users",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="usertype",
     *                         type="object",
     *                         ref="#/components/schemas/User"
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

    public function get_users(Request $request)
    {
        try {
            Log::info('Get users Endpoint Entered.');

            Log::debug('Get users Endpoint - All Params: ' . json_encode($request->all()));
            $page_number = $request->has('page') && $request->page != null ? $request->page : 1;
            $records = $request->has('records') && $request->records != null ? $request->records : 20;
            $data['page'] = $page_number;
            $data['records'] = $records;

            $query = User::with('userType', 'roles', 'roles.privileges');
            $query = $query->where('deleted', NULL);

            if ($request->has('user_id') && $request->user_id != null) {
                $query = $query->where('id', $request->user_id);
            }
            if ($request->has('user_type_id') && $request->user_type_id != null) {
                $query = $query->where('user_type_id', $request->user_type_id);
            }
            if ($request->has('name') && $request->name != null) {
                $query = $query->where(function ($query) use ($request) {
                    $query->where('first_name', 'like', $request->name . '%')
                        ->orWhere('last_name', 'like', $request->name . '%')
                        ->orWhere('username', 'like', $request->name . '%');
                });
            }
            if ($request->has('email') && $request->email != null) {
                $query = $query->where('email', $request->email);
            }
            if ($request->has('phone') && $request->phone != null) {
                $query = $query->where('phone', 'like', '%' . $request->phone . '%');
            }

            $data['count'] = $query->count();
            $pagination = $query
                ->paginate($records, ['*'], 'page', $page_number);
            $data['users'] = $pagination->items();
            Log::debug('Get users Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "users retrieved successfully");
        } catch (Exception $e) {
            Log::error('Get users Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get users Endpoint Exited.');
        }
    }




    //
    /**
     * @OA\POST(
     *     path="/api/v1/reset_2fa",
     *     summary="Reset User 2fa",
     *     security={{"bearerAuth":{}}},
     *      tags={"User"},
     *     description="Reset user 2fa",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"user_id"},
     *              @OA\Property(property="user_id", type="integer"),
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

    public function reset2fa(Request $request)
    {
        try {
            Log::info('Reset 2fa of user Endpoint Entered.');

            Log::debug('Reset 2fa Endpoint - All Params: ' . json_encode($request->all()));
            $rules = [
                'user_id' => ['required', 'integer', 'exists:users,id,deleted,NULL'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            $user = User::find($request->user_id);
            $user->update(
                [
                    "google2fa_secret" => NULL
                ]
            );
            $data = User::find($request->user_id);
            Log::debug('Assign role Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "User's 2fa updated successfully");
        } catch (Exception $e) {
            Log::error('Assign role Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Assign role Endpoint Exited.');
        }
    }

    public function get_detail_user(Request $request) {
        try {
            Log::info('Get detail User  Endpoint Entered.');

            Log::debug('Get detail User Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'id' => 'required|string'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }


            $category = User::where('id', $data['id'])->get();

            if ($category == null) {
                return $this->sendError("Contrat de Location not found");
            }

            Log::debug('detail User - Response: ' . json_encode($data));

            return $this->sendResponse($category, "Detail User retrieve successfully");
        } catch (Exception $e) {
            Log::error('Cancel User Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Cancel User Endpoint Exited.');
        }
    }

    //
    //
    /**
     * @OA\Get(
     *     path="/api/v1/get_user_datatable",
     *     summary="Get All Users working with datatable implementation frontEnd",
     *      tags={"users"},
     *     description="Get All Users working with datatable implementation frontEnd",
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="bool"),
     *             @OA\Property(property="code", type="string"),
     * @OA\Property(
     *     property="data",
     *     type="object",
     * ),
     *             @OA\Property(property="message", type="string"),
     *            )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         ref="#/components/responses/Requestfails"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         ref="#/components/responses/TokenIvalid"
     *     ),
     *     @OA\Response(
     *         response=202,
     *         ref="#/components/responses/ApplicationUnknown"
     *     ),
     * )
     */

    public function get_user_datatable(Request $request)
    {
        try {
            Log::info('Get users datatable Endpoint Entered.');

            Log::debug('Get users datatable Endpoint - All Params: ' . json_encode($request->all()));
            $product = User::with('user_type', 'roles', 'roles.privileges')->select('users.*')
                ->where('deleted', NULL);
            Log::debug('Get users datatable Endpoint - Response: ' . json_encode($product));
            return DataTables::of($product)
                ->addIndexColumn()
                ->make(true);
        } catch (Exception $e) {
            Log::error('Get users datatable Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get users datatable Endpoint Exited.');
        }
    }


    //
    /**
     * @OA\Post(
     *     path="/api/v1/add_user",
     *     security={{"bearerAuth":{}}},
     *     summary="Add BackOffice user",
     *     description="Add BackOffice user",
     *      tags={"User"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"last_name","phone","phone_code","email","role_id"},
     *              @OA\Property(property="last_name", type="string"),
     *              @OA\Property(property="first_name", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="phone_code", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="role_id", type="integer"),
     *              @OA\Property(property="order_budget_treshold_id", type="integer"),
     *              @OA\Property(property="offer_amount_treshold_id", type="integer"),
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
    public function add_user(Request $request)
    {
        try {
            Log::info('Add users Endpoint Entered.');

            Log::debug('Add users Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'email' => ['required', 'email', 'unique:users,email', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'role_id' => ['required', 'exists:roles,id,deleted,NULL'],
                'phone' => [
                    'required',
                    'string',
                    'max:15',
                    Rule::unique('users')->where(function ($query) use ($data) {
                        return $query->where('phone', $data['phone'])
                            ->where('phone_code', $data['phone_code']);
                    }),
                ],
                'phone_code' => ['required', 'string', 'max:5'],
            ];

            if ($request->has('first_name')) {
                $rules['first_name'] = ['required', 'string', 'max:100'];
            }

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            $data['password'] = Hash::make("bjkhbcebjkekznejn&&&?###jksçoà");
            $user = User::create(array_merge($data, ['user_type_id' => Role::find($data['role_id'])->user_type->id]));
            UserRole::create([
                'user_id' => $user->id,
                'role_id' => $data['role_id']
            ]);
            config(['auth.passwords.users.expire' => 1440]);
            $user->sendPasswordResetNotification(app('auth.password.broker')->createToken($user));
            config(['auth.passwords.users.expire' => 30]);
            $data['user'] = User::with('user_type', 'roles', 'roles.privileges')->find($user->id);

            Log::debug('Add users Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Password reset email sent successfully to user");
        } catch (Exception $e) {
            Log::error('Add users Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Add users Endpoint Exited.');
        }
    }

    //
    /**
     * @OA\Post(
     *     path="/api/v1/update_user",
     *     security={{"bearerAuth":{}}},
     *     summary="Update user",
     *     description="Update user",
     *      tags={"User"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"user_id"},
     *              @OA\Property(property="user_id", type="integer"),
     *              @OA\Property(property="last_name", type="string"),
     *              @OA\Property(property="first_name", type="string"),
     *              @OA\Property(property="phone", type="string"),
     *              @OA\Property(property="phone_code", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="role_id", type="integer"),
     *              @OA\Property(property="order_budget_treshold_id", type="integer"),
     *              @OA\Property(property="offer_amount_treshold_id", type="integer"),
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
    public function update_user(Request $request)
    {
        try {
            Log::info('Update users Endpoint Entered.');

            Log::debug('Update users Endpoint - All Params: ' . json_encode($request->all()));
            $data_t = $request->all();
            $rules = [
                'user_id' => ['required', 'exists:users,id,deleted,NULL'],
            ];

            if ($request->has('email')) {
                $rules['email'] = ['required', 'email', 'unique:users,email,' . $request->user_id, 'max:100'];
            }
            if ($request->has('last_name')) {
                $rules['last_name'] = ['required', 'string', 'max:100'];
            }
            if ($request->has('first_name')) {
                $rules['first_name'] = ['required', 'string', 'max:100'];
            }
            if ($request->has('phone')) {
                $rules['phone'] = [
                    'required',
                    'string',
                    'max:15',
                    Rule::unique('users')->where(function ($query) use ($data_t) {
                        $query->where('phone', $data_t['phone']);
                        $query->where('phone_code', $data_t['phone_code']);
                        $query->where('id', '!=', $data_t['user_id']);
                    }),
                ];
            }
            if ($request->has('phone_code')) {
                $rules['phone_code'] = ['required', 'string', 'max:5'];
            }
            if ($request->has('role_id')) {
                $rules['role_id'] = ['required', 'exists:roles,id,deleted,NULL'];
            }


            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $user = User::find($request->user_id);
            if ($request->has('role_id')) {
                UserRole::where('user_id', $user->id)->find()->update([
                    'role_id' => $request->role_id
                ]);
            }

            $data_update = $request->all();
            unset($data_update['user_id']);
            unset($data_update['role_id']);
            $user->update($data_update);

            $data['user'] = User::with('user_type', 'roles', 'roles.privileges')->find($user->id);

            Log::debug('Update users Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "User updated successfully");
        } catch (Exception $e) {
            Log::error('Update users Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Update users Endpoint Exited.');
        }
    }

    //
    /**
     * @OA\Post(
     *     path="/api/v1/resend_reset_password_notification",
     *     security={{"bearerAuth":{}}},
     *     summary="Resend Password Reset Notification",
     *     description="Resend Password Reset Notification",
     *      tags={"User"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"user_id"},
     *              @OA\Property(property="user_id", type="integer"),
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
    public function resend_reset_password_notification(Request $request)
    {
        try {
            Log::info('Resend reset password notification Endpoint Entered.');

            Log::debug('Resend reset password notification Endpoint - All Params: ' . json_encode($request->all()));
            $data = $request->all();
            $rules = [
                'user_id' => [
                    'required',
                    Rule::exists('users', 'id')->where(function ($query) use ($data) {
                        $query->whereNull('deleted');
                    }),
                ],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            $user = User::find($request->user_id);
            config(['auth.passwords.users.expire' => 1440]);
            $user->sendPasswordResetNotification(app('auth.password.broker')->createToken($user));
            config(['auth.passwords.users.expire' => 30]);
            $data['user'] = User::with('user_type', 'roles', 'roles.privileges')->find($user->id);

            Log::debug('Resend reset password notification Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Password reset email sent successfully to user");
        } catch (Exception $e) {
            Log::error('Resend reset password notification Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Resend reset password notification Endpoint Exited.');
        }
    }

    //
    /**
     * @OA\Post(
     *     path="/api/v1/delete_user",
     *     security={{"bearerAuth":{}}},
     *     summary="Delete User",
     *     description="Delete User",
     *      tags={"User"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"user_id"},
     *              @OA\Property(property="user_id", type="integer"),
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
    public function delete_user(Request $request)
    {
        try {
            Log::info('Delete users Endpoint Entered.');

            Log::debug('Delete users Endpoint - All Params: ' . json_encode($request->all()));
            $rules = [
                'user_id' => ['required', 'integer', 'exists:users,id,deleted,NULL'],
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }
            User::find($request->user_id)->update([
                'deleted' => 1,
                'deleted_at' => now()
            ]);
            $user =  User::select('users.*')->find($request->user_id);
            $data['user'] = $user;
            Log::debug('Delete users Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "User deleted successfully");
        } catch (Exception $e) {
            Log::error('Delete users Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Delete users Endpoint Exited.');
        }
    }
}
