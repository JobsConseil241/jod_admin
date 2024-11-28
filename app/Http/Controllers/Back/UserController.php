<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function profil()
    {
        return view('backend.user.profil');
    }

    public function reset2fa(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'reset_2fa', ['user_id' => $request->user_id]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return back()->with('success', "le 2fa a bien été réinitialisé.");
        } else {
            return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
        }
    }

    public function users()
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_users');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $users = $object->data->users;
        } else {
            $users = [];
        }

        $response_ut = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_user_type');

        $object_ut = json_decode($response_ut->body());

        if ($object_ut && $object_ut->success == true) {
            $types = $object_ut->data->usertypes;
        } else {
            $types = [];
        }

        //roles
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_roles');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $roles = $object->data->roles;
        } else {
            $roles = [];
        }

        return view('back.user.list', compact('users', 'types', 'roles'));
    }

    public function administrators()
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_users');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $users = $object->data->users;
        } else {
            $users = [];
        }

        $response_ut = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_user_type');

        $object_ut = json_decode($response_ut->body());

        if ($object_ut && $object_ut->success == true) {
            $types = $object_ut->data->usertypes;
        } else {
            $types = [];
        }

        //roles
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_roles');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $roles = $object->data->roles;
        } else {
            $roles = [];
        }

        return view('back.user.list', compact('users', 'types', 'roles'));
    }

    protected function validator(array $data)
    {

        //les rules de l'utilisateur
        $rules = [
            'email' => ['required', 'email', 'unique:users,email', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
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
            'role_id' => ['required', 'integer', 'exists:roles,id']
        ];

        return Validator::make($data, $rules);
    }

    public function store(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'add_user', [
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone_code' => $request->phone_code,
            'role_id' => $request->role_id,
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return back()->with('success', "l'utilisateur a été créé avec succès.");
        } else {

            return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
        }
    }

    public function edit(Request $request)
    {
        //
        $Lang = new LanguageService();
        $access_token = Session::get('personnalToken');
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(
            env('SERVER_PC') . 'get_users',
            [
                'user_id' => $request->id,
            ]
        );

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $user = $object->data->users[0];
            if ($request->action == "edit") {
                $body = '
                <!--begin::Form-->
                    <form id="kt_modal_add_user_form" class="form" method="post" action="' . url('backend/user-update/' . $request->id) . '">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">

                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                            data-kt-scroll-dependencies="#kt_modal_add_user_header"
                            data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Prénom</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="firstname" value="' . $user->first_name . '"
                                    class="form-control form-control-solid mb-3 mb-lg-0" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Nom</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="lastname" value="' . $user->last_name . '"
                                    class="form-control form-control-solid mb-3 mb-lg-0" />
                                <!--end::Input-->
                            </div>
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" value="' . $user->email . '" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Téléphone</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="tel" id="_phone" name="phone" value="' . $user->phone . '" class="form-control form-control-solid mb-3 mb-lg-0" />
                                <input id="_phone_code" type="hidden" name="phone_code" value="' . $user->phone_code . '" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-10">
                            <button type="reset" class="btn btn-light me-3"
                                data-kt-users-modal-action="cancel">Annuler</button>
                            <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                                <span class="indicator-label">Soumettre</span>
                                <span class="indicator-progress">Patientez ...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                    ';
            } elseif ($request->action == "delete") {

                $body = '
                  <!--begin::Form-->
                  <form id="kt_modal_add_permission_form" class="form" action="' . url('backend/user-update/' . $request->id) . '" method="POST">
                      <input type="hidden" name="_token" value="' . csrf_token() . '">
                      <input type="hidden" name="delete" value="true">

                      <!--begin::Input group-->
                      <div class="fv-row mb-7">
                          <!--begin::Label-->
                          <p>' . $Lang->trans('disclaimer_suppression_utilisateur') . '</p>
                          <!--end::Label-->
                      </div>
                      <!--end::Input group-->

                      <!--begin::Actions-->
                      <div class="text-center pt-15">
                          <button type="submit" class="btn btn-danger">
                              <span class="indicator-label">Supprimer</span>
                          </button>
                      </div>
                      <!--end::Actions-->
                  </form>
                  <!--end::Form-->';
            }

            $response = array(
                "body" => $body,
            );

            return response()->json($response);
        } else {
            $user = [];
        }
    }

    public function assign(Request $request)
    {
        //
        $body = '';

        $access_token = Session::get('personnalToken');

        //roles
        $response_r = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_roles');

        $object_r = json_decode($response_r->body());

        if ($object_r && $object_r->success == true) {
            $roles = $object_r->data->roles;
        } else {
            $roles = [];
        }

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(
            env('SERVER_PC') . 'get_users',
            [
                'user_id' => $request->id,
            ]
        );

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $user = $object->data->users[0];

            if ($request->action == "assign") {

                $body = '
                <!--begin::Form-->
                <form id="kt_modal_assign_user_form" class="form" method="POST" action="' . url('backend/user-assign-role/') . '">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="user_id" value="' . $user->id . '">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_user_header"
                        data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">

                        <!--begin::Input group-->
                        <div class="mb-5">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Rôles</label>
                            <!--end::Label-->
                            <!--begin::Roles-->';
                foreach ($roles as $role) {
                    $body .= '<!--begin::Input row-->
                    <div class="d-flex fv-row">
                        <!--begin::Radio-->
                        <div class="form-check form-check-custom form-check-solid">
                            <!--begin::Input-->
                            <input class="form-check-input me-3" name="role_id" type="radio"
                                value="' . $role->id . '" id="kt_modal_update_role_option_' . $role->id . '" ' . ($user->roles[0]->id == $role->id ? 'checked' : '') . ' />
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label" for="kt_modal_update_role_option_' . $role->id . '">
                                <div class="fw-bold text-gray-800">' . $role->name . '</div>
                                <div class="text-gray-600">' . $role->description . '</div>
                            </label>
                            <!--end::Label-->
                        </div>
                        <!--end::Radio-->
                    </div>
                    <!--end::Input row-->
                    <div class="separator separator-dashed my-5"></div>';
                }

                $body .= '</div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3"
                            data-kt-users-modal-action="cancel">Annuler</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Soumettre</span>
                            <span class="indicator-progress">Patientez ...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->';
            }

            $response = array(
                "body" => $body,
            );

            return response()->json($response);
        } else {
            $user = [];
        }
    }

    public function update(Request $request, User $user)
    {
        $access_token = Session::get('personnalToken');

        if ($request->has('delete') && $request->delete == true) {

            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $access_token
            ])->post(
                env('SERVER_PC') . 'delete_user',
                [
                    'user_id' => $user->id,
                ]
            );

            $object = json_decode($response->body());

            if ($object->success == true) {
                return back()->with('success', "Utilisateur supprimé avec succès.");
            } else {
                return back()->with('error', $object->message);
            }
        }

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'update_user', [
            'last_name' => $request->lastname,
            'first_name' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone_code' => $request->phone_code,
            'user_id' => $user->id,
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return back()->with('success', "L'utilisateur a été mis à jour avec succès.");
        } else {
            return back()->with('error',  $object->message ??  'Une erreur s\'est produite.');
        }
    }

    public function updateProfil(Request $request)
    {

        $access_token = Session::get('personnalToken');
        $user = Auth::user();

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'update_user', [
            'email' => $request->email,
            'phone' => $request->phone,
            'phone_code' => $request->phone_code,
            'user_id' => $user->id,
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $user = $object->data->user;
            return back()->with('success', "Profil mis à jour");
        } else {
            return back()->with('error', $object->message ??  "une erreur s'est produite.");
        }
    }

    public function assignRole(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'assign_role', [
            'role_id' => $request->role_id,
            'user_id' => $request->user_id
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return back()->with('success', "Rôle a été assigné avec succès.");
        } else {
            return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
        }
    }
}
