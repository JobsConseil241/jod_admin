<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Privilege;
use App\Models\Role;
use App\Models\RolePrivilege;
use App\Models\UserType;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{


    public function userType()
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_user_type');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $types = $object->data->usertypes;
        } else {
            $types = [];
        }

        return view('back.user.usertype', compact('types'));
    }

    public function privileges()
    {
        $access_token = Session::get('personnalToken');
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_privilege/');

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $privileges = $object->data->privileges;
        } else {
            $privileges = [];
        }

        //user_types
        $response_ut = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_user_types/');

        $object_ut = json_decode($response_ut->body());

        if ($object_ut && $object_ut->success == true) {
            $types = $object_ut->data->usertypes;
        } else {
            $types = [];
        }

        return view('back.user.privilege', compact('privileges', 'types'));
    }

    //
    public function index()
    {
        $access_token = Session::get('personnalToken');

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

        //privileges
        $response_pr = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_privilege');

        $object_pr = json_decode($response_pr->body());

        if ($object_pr && $object_pr->success == true) {
            $privileges = $object_pr->data->privileges;
        } else {
            $privileges = [];
        }

        //user_types
        $response_ut = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_user_type');

        $object_ut = json_decode($response_ut->body());

        if ($object_ut && $object_ut->success == true) {
            $types = $object_ut->data->usertypes;
        } else {
            $types = [];
        }

        return view('back.user.role', compact('roles', 'privileges', 'types'));
    }

    public function save(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'add_role', [
            'name' => $request->name,
            'description' => $request->description,
            'user_type_id' => $request->user_type_id
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {

            if (!empty($request->privileges)) {
                foreach ($request->privileges as $pr) {
                    $response_pr = Http::withHeaders([
                        "Authorization" => "Bearer " . $access_token
                    ])->post(env('SERVER_PC') . 'assign_privilege', [
                        'privilege_id' => $pr,
                        'role_id' => $object->data->role->id,
                        'user_type_id' => $request->user_type_id
                    ]);
                }
            }

            return back()->with('success', "Rôle créé avec succès.");
        } else {
            return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
        }

        return back()->with('error', "Une erreur s'est produite.");
    }

    public function delete($id)
    {
        $access_token = Session::get('personnalToken');

        $response_pr = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'clear_privilege', [
            'role_id' => $id,

        ]);

        $object_pr = json_decode($response_pr->body());

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'delete_role', [
            'role_id' => $id,

        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return back()->with('success', "Rôle supprimé avec succès.");
        } else {
            return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request)
    {
        //
        $access_token = Session::get('personnalToken');
        $Lang = new LanguageService();

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(
            env('SERVER_PC') . 'get_roles',
            [
                'role_id' => $request->id,
            ]
        );

        //privileges
        $response_pr = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_privilege');

        $object_pr = json_decode($response_pr->body());

        if ($object_pr && $object_pr->success == true) {
            $privileges = $object_pr->data->privileges;
        } else {
            $privileges = [];
        }

        //user_types
        $response_ut = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->get(env('SERVER_PC') . 'get_user_type');

        $object_ut = json_decode($response_ut->body());

        if ($object_ut && $object_ut->success == true) {
            $types = $object_ut->data->usertypes;
        } else {
            $types = [];
        }

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $role = $object->data->roles[0];
            $body = '';

            if ($request->action == "view") {
                $body = '';
            } elseif ($request->action == "edit") {
                $body = '
                <form action="' . url('backend/role/edit/' . $role->id) . '" method="POST">

                    <div class="ti-modal-header">
                        <h3 class="ti-modal-title">
                            Modifier un rôle
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
                            <label for="hs-select-label" class="ti-form-select-label">Type d\'utilisateur</label>
                            <select name="user_type_id" id="hs-select-label" class="ti-form-select">';
                foreach ($types as $type) {
                    $body .= '<option value="' . $type->id . '"
                                            ' . ($type->id == $role->user_type->id ? 'selected' : '') . '>
                                            ' . $type->name . '</option>';
                }

                $body .= '</select>
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                        </div>

                        <div class="mb-3">
                            <label for="input-label" class="ti-form-label">Nom</label>
                            <input type="text" id="input-label" class="ti-form-input" value="' . $role->name . '">
                        </div>

                        <div class="mb-3">
                            <label for="input-description" class="ti-form-label">Description</label>
                            <textarea class="ti-form-input" rows="3" name="description">' . $role->description . '</textarea>
                        </div>

                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label for="input-label" class="ti-form-label">Privilèges</label>
                            <!--end::Label-->
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-500 fw-semibold">';
                foreach ($privileges as $pr) {
                    $body .= '<!--begin::Table row-->
                                            <tr>
                                                <!--begin::Label-->
                                                <td class="text-gray-500">
                                                    <label
                                                        class="max-w-xs flex p-3 w-full bg-white border border-gray-200 rounded-sm text-sm focus:border-primary focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:text-white/70">
                                                        <input name="privileges[]" type="checkbox"
                                                            value="' . $pr->id . '"
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded text-primary pointer-events-none focus:ring-primary dark:bg-bgdark dark:border-white/10 dark:checked:bg-primary dark:checked:border-primary dark:focus:ring-offset-white/10"
                                                            id="vertical-checkbox-checked-in-form">
                                                        <span
                                                            class="text-sm text-gray-500 ltr:ml-2 rtl:mr-2 dark:text-white/70">' . $pr->name . '</span>
                                                    </label>
                                                </td>
                                                <!--end::Label-->
                                            </tr>
                                            <!--end::Table row-->
                                       ';
                }

                $body .= '
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Permissions-->
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
                        Supprimer un rôle
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
                        Êtes-vous sûr de vouloir supprimer ce rôle ?
                        </p>
                    </div>
                    <div class="ti-modal-footer">
                        <button type="button"
                        class="hs-dropdown-toggle ti-btn ti-border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:ring-offset-white focus:ring-primary dark:bg-bgdark dark:hover:bg-black/20 dark:border-white/10 dark:text-white/70 dark:hover:text-white dark:focus:ring-offset-white/10"
                        data-hs-overlay="#cardModalView">
                        Fermer
                        </button>
                        <a class="ti-btn ti-btn-danger"
                        href="' . url('backend/delete-role/' . $role->id) . '">
                        Supprimer
                        </a>
                    </div>
                ';
            }

            $response = array(
                "body" => $body,
            );

            return response()->json($response);
        } else {
            $response = array(
                "body" => 'Une erreur s\'est produite !',
            );

            return response()->json($response);
        }
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        $access_token = Session::get('personnalToken');
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(env('SERVER_PC') . 'update_role', [
            'name' => $request->name,
            'description' => $request->description,
            'user_type_id' => $request->user_type_id,
            'id' => $id
        ]);

        $object = json_decode($response->body());

        if ($object && $object->success == true) {

            $role = $object->data->role;

            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $access_token
            ])->get(env('SERVER_PC') . 'get_privilege');

            $object = json_decode($response->body());

            if ($object && $object->success == true) {
                $privileges = $object->data->privileges;
            } else {
                $privileges = [];
            }

            foreach ($role->privileges as $prp) {
                if (!in_array($prp->id, $request->privileges)) {
                    $response_pr = Http::withHeaders([
                        "Authorization" => "Bearer " . $access_token
                    ])->post(env('SERVER_PC') . 'remove_privilege', [
                        'privilege_id' => $prp->id,
                        'role_id' => $role->id,
                    ]);
                }
            }

            foreach ($request->privileges as $pr) {
                $isPrivilegeAssigned = false;
                foreach ($role->privileges as $prp) {
                    if ($prp->id == $pr) {
                        $isPrivilegeAssigned = true;
                        break;
                    }
                }

                if (!$isPrivilegeAssigned) {
                    $response_pr = Http::withHeaders([
                        "Authorization" => "Bearer " . $access_token
                    ])->post(env('SERVER_PC') . 'assign_privilege', [
                        'privilege_id' => $pr,
                        'role_id' => $role->id,
                        'user_type_id' => $role->user_type->id,
                    ]);
                }
            }

            return back()->with('success', "Rôle mis à jour avec succès.");
        } else {
            return back()->with('error', $object->message ??  'Une erreur s\'est produite.');
        }
    }

    public function assignRole(Request $request, $id) {}

    static function check_object($object, $array)
    {
        $prExiste = false;

        foreach ($array as $ar) {
            if ($object->id == $ar->id) {
                $prExiste = true;
                break; // Sortir de la boucle dès que la correspondance est trouvée
            }
        }

        return $prExiste;
    }
}
