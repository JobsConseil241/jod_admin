<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */

    public function index()
    {
        $response = Http::get(env('SERVER_PC') . 'get_langs/', ['number' => 1000]);

        $object = json_decode($response->body());
        if ($object->success == false) {
            dd($response);
        }
        if ($object && $object->success == true) {
            $languages = $object->data->languages;
        } else {
            $languages = [];
        }

        return view('backend.language.index', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $access_token = Session::get('personnalToken');

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(
            env('SERVER_PC') . 'add_language/',
            [
                'app' => $request->input('app'),
                'key' => $request->input('key'),
                'fr' => $request->input('fr'),
                'en' => $request->input('en'),
            ]
        );

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            return back()->with('success', "Langue créé avec succès.");
        } else {
            return back()->with('error', "une erreur s'est produite !");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
        $Lang = new LanguageService();

        $response = Http::withHeaders([
            'api-key' => env('API_KEY'),
            'api-secret' => env('API_SECRET'),
        ])->get(
            env('SERVER_PC') . 'get_langs',
            [
                'key' => $request->key,
            ]
        );

        $object = json_decode($response->body());




        if ($object && $object->success == true) {
            $language = $object->data->languages[0];

            if ($request->action == "edit") {

                $body = '
                <!--begin::Form-->
                <form id="kt_modal_add_permission_form" class="form" action="' . url('backend/language/' . $language->id) . '" method="POST">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Application</span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                data-bs-html="true" data-bs-content="Plateforme de la langue">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-control form-control-solid" name="app">
                            <option ' . ($language->app == 'WEB' ? 'selected' : '') . ' value="WEB">WEB</option>
                            <option ' . ($language->app == 'MOB' ? 'selected' : '') . ' value="MOB">MOBILE</option>
                        </select>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Clé</span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                data-bs-html="true" data-bs-content="la clé est unique">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="Entrer la clé"
                            name="key" value="' . $language->key . '" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->



                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Français</span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                data-bs-html="true" data-bs-content="la valeur de la clé">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <textarea class="form-control form-control-solid" name="fr">' . $language->fr . '</textarea>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Anglais</span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                data-bs-html="true" data-bs-content="la valeur de la clé">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <textarea class="form-control form-control-solid" name="en">' . $language->en . '</textarea>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3"
                            data-kt-permissions-modal-action="cancel">Fermer</button>
                        <button type="submit" class="btn btn-primary"
                            data-kt-permissions-modal-action="submit">
                            <span class="indicator-label">Valider</span>
                            <span class="indicator-progress">Patientez...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->';
            } elseif ($request->action == "delete") {

                $body = '
                  <!--begin::Form-->
                  <form id="kt_modal_add_permission_form" class="form" action="' . url('backend/language/' . $language->id) . '" method="POST">
                  <input type="hidden" name="_token" value="' . csrf_token() . '">
                      <input type="hidden" name="delete" value="true">
                      <input type="hidden" name="key" value="' . $language->key . '">

                      <!--begin::Input group-->
                      <div class="fv-row mb-7">
                          <!--begin::Label-->
                          <p>' . $Lang->trans('disclaimer_suppression_language') . '</p>
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
            $language = [];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $access_token = Session::get('personnalToken');
        if ($request->has('delete') && $request->delete == true) {

            $response = Http::withHeaders([
                "Authorization" => "Bearer " . $access_token
            ])->post(
                env('SERVER_PC') . 'delete_languages',
                [
                    'key' => $request->input('key'),
                ]
            );

            $object = json_decode($response->body());

            if ($object->success == true) {
                return back()->with('success', "Texte supprimé avec succès.");
            } else {
                return back()->with('error', $object->message);
            }
        }
        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $access_token
        ])->post(
            env('SERVER_PC') . 'update_language/',
            [
                'app' => $request->input('app'),
                'key' => $request->input('key'),
                'fr' => $request->input('fr'),
                'en' => $request->input('en'),

            ]
        );

        $object = json_decode($response->body());

        if ($object->success == true) {
            return back()->with('success', "Langue mis à jour avec succès.");
        } else {
            return back()->with('error', $object->message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        Language::find($id)->delete();
        return response()->json(['success' => true], 200);
    }

    /**
     * Switch language
     *
     * @return Response
     */
    public function switcher(Request $request)
    {
        $rules = [
            'lang' => 'in:fr,en'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {
            session()->put('locale', $request->lang);
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
