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
        ])->get(env('SERVER_PC') . 'get_users', ['user_type' => 1000002]);

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

        return view('back.user.administrator', compact('users', 'types', 'roles'));
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
                    <form action="' . url('backend/user-update/' . $request->id) . '" method="POST">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">

                    <div class="ti-modal-header">
                        <h3 class="ti-modal-title">
                            Modifier un administrateur
                        </h3>
                        <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"
                            data-hs-overlay="#hs-basic-modal">
                            <span class="sr-only">Close</span>
                            <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                                    fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="ti-modal-body">

                        <div class="mb-3">
                            <label for="input-lastname" class="ti-form-label">Nom</label>
                            <input type="text" name="last_name" id="input-lastname" class="ti-form-input" value="' . $user->last_name . '" required>
                        </div>

                        <div class="mb-3">
                            <label for="input-firstname" class="ti-form-label">Prénom</label>
                            <input type="text" name="first_name" id="input-firstname" value="' . $user->first_name . '" class="ti-form-input">
                        </div>

                        <div class="mb-3">
                            <label for="input-email" class="ti-form-label">Email</label>
                            <input type="email" name="email" id="input-email" class="ti-form-input" value="' . $user->email . '" required>
                        </div>

                        <div class="mb-3">
                            <label for="input-phone" class="ti-form-label">Téléphone</label>
                            <input type="tel" name="phone" id="phone" class="ti-form-input" value="' . $user->phone . '" required>
                            <input id="phone_code" type="hidden" name="phone_code" value="' . $user->phone_code . '" />
                        </div>

                    </div>
                    <div class="ti-modal-footer">
                        <button type="button"
                            class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                            data-hs-overlay="#cardModalView">
                            Annuler
                        </button>
                        <button class="ti-btn ti-btn-primary" type="submit">
                            Valider
                        </button>
                    </div>
                </form>
                    ';
            } elseif ($request->action == "delete") {

                $body = '
                  <div class="ti-modal-header">
                        <h3 class="ti-modal-title">
                        Supprimer un administrateur
                        </h3>
                        <button type="button" class="hs-dropdown-toggle ti-modal-clode-btn"
                        data-hs-overlay="#hs-basic-modal">
                        <span class="sr-only">Close</span>
                        <svg class="w-3.5 h-3.5" width="8" height="8" viewBox="0 0 8 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                            d="M0.258206 1.00652C0.351976 0.912791 0.479126 0.860131 0.611706 0.860131C0.744296 0.860131 0.871447 0.912791 0.965207 1.00652L3.61171 3.65302L6.25822 1.00652C6.30432 0.958771 6.35952 0.920671 6.42052 0.894471C6.48152 0.868271 6.54712 0.854471 6.61352 0.853901C6.67992 0.853321 6.74572 0.865971 6.80722 0.891111C6.86862 0.916251 6.92442 0.953381 6.97142 1.00032C7.01832 1.04727 7.05552 1.1031 7.08062 1.16454C7.10572 1.22599 7.11842 1.29183 7.11782 1.35822C7.11722 1.42461 7.10342 1.49022 7.07722 1.55122C7.05102 1.61222 7.01292 1.6674 6.96522 1.71352L4.31871 4.36002L6.96522 7.00648C7.05632 7.10078 7.10672 7.22708 7.10552 7.35818C7.10442 7.48928 7.05182 7.61468 6.95912 7.70738C6.86642 7.80018 6.74102 7.85268 6.60992 7.85388C6.47882 7.85498 6.35252 7.80458 6.25822 7.71348L3.61171 5.06702L0.965207 7.71348C0.870907 7.80458 0.744606 7.85498 0.613506 7.85388C0.482406 7.85268 0.357007 7.80018 0.264297 7.70738C0.171597 7.61468 0.119017 7.48928 0.117877 7.35818C0.116737 7.22708 0.167126 7.10078 0.258206 7.00648L2.90471 4.36002L0.258206 1.71352C0.164476 1.61976 0.111816 1.4926 0.111816 1.36002C0.111816 1.22744 0.164476 1.10028 0.258206 1.00652Z"
                            fill="currentColor" />
                        </svg>
                        </button>
                    </div>
                    <div class="ti-modal-body">
                        <p class="mt-1 text-gray-800 dark:text-white/70">
                        Êtes-vous sûr de vouloir supprimer cet administrateur ?
                        </p>
                    </div>
                    <div class="ti-modal-footer">
                        <form id="kt_modal_add_permission_form" class="form" action="' . url('backend/user-update/' . $request->id) . '" method="POST">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="delete" value="true">

                            <button type="button"
                                class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                                data-hs-overlay="#cardModalView">
                                Fermer
                            </button>

                            <button class="ti-btn ti-btn-danger" type="submit">
                                Supprimer
                            </button>
                        </form>
                        <!--end::Form-->
                    </div>
                  ';
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
