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
        dd($response);
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
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelOne">' . $Lang->trans('edit_role') . '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <div class="mb-3">
                                <label for="user_type_id" class="col-form-label">' . $Lang->trans('user_type') . '</label>
                                <select id="selectOne" class="form-control" name="user_type_id">';

                foreach ($types as $type) {
                    $body .= '<option value="' . $type->id . '"
                                            ' . ($type->id == $role->user_type->id ? 'selected' : '') . '>
                                            ' . $type->name . '</option>';
                }

                $body .= '</select>
                            </div>

                            <div class="mb-3">
                                <label for="name" class="col-form-label">' . $Lang->trans('name') . '</label>
                                <input type="text" class="form-control" name="name" value="' . $role->name . '">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="col-form-label">' . $Lang->trans('description') . '</label>
                                <textarea class="form-control" name="description">' . $role->description . '</textarea>
                            </div>

                            <!--begin::Permissions-->
                            <div class="fv-row">
                                <!--begin::Label-->
                                <label class="fs-5 fw-bold form-label mb-2">' . $Lang->trans('privileges') . '</label>
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
                                                    <td class="text-gray-500">' . $pr->name . '</td>
                                                    <!--end::Label-->
                                                    <!--begin::Options-->
                                                    <td>
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex">
                                                            <!--begin::Checkbox-->
                                                            <label
                                                                class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="' . $pr->id . '"
                                                                    ' . ($this::check_object($pr, $role->privileges) ? 'checked' : '') . '
                                                                    name="privileges[]" />
                                                            </label>
                                                            <!--end::Checkbox-->

                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </td>
                                                    <!--end::Options-->
                                                </tr>
                                                <!--end::Table row-->';
                }

                $body .= ' </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Permissions-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">' . $Lang->trans('close') . '</button>
                        <button type="submit" class="btn btn-primary">' . $Lang->trans('valid') . '</button>
                    </div>
                    </form>
                ';
            } elseif ($request->action == "delete") {
                $body = '
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">' . $Lang->trans('delete_role') . '</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        ' . $Lang->trans('you_want_delete_role') . '
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">' . $Lang->trans('close') . '</button>
                        <a href="' . url('backend/delete-role/' . $role->id) . '">
                            <button type="button" class="btn btn-danger">' . $Lang->trans('delete') . '</button>
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
