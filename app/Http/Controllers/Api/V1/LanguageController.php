<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class LanguageController extends BaseController
{

    /**
     * @OA\Post(
     *     path="/api/v1/add_language",
     *     summary="Add Language",
     *     description="Add new Languages",
     *     security={{"bearerAuth":{}}},
     *      tags={"Languages"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"key","app","fr","en"},
     *              @OA\Property(property="key", type="string", format="text"),
     *              @OA\Property(property="app", type="string", format="text"),
     *              @OA\Property(property="fr", type="string", format="text"),
     *              @OA\Property(property="en", type="string", format="text"),
     *              )
     *          )
     *      ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="bool"),
     *             @OA\Property(property="code", type="string"),
     *             @OA\Property(property="data",
     *                 type="object",
     *                 @OA\Property(
     *                      property="language",
     *                      type="object",
     *                      ref="#/components/schemas/Language"
     *                   )
     *             ),
     *             @OA\Property(property="message", type="string"),
     *            )
     *     ),
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



    public function language_create(Request $request): JsonResponse
    {
        $validator = $this->language_create_validator($request->all());
        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->sendError($errors->first(), $errors);
        }
        $input = $request->all();
        $language = $this->lang_create($input);
        $success['language'] = new LanguageResource($language);
        return $this->sendResponse($success, 'Language created successfully');
    }

    protected function language_create_validator(array $data)
    {
        return Validator::make($data, [
            'key' => ['required', 'string', 'max:50', 'unique:languages'],
            'app' => ['required', 'string', 'max:4', 'in:MOB,WEB'],
            'fr' => ['required', 'string'],
            'en' => ['required', 'string'],
        ]);
    }

    protected function lang_create(array $data)
    {
        $language = Language::create([
            'key' => $data['key'],
            'app' => $data['app'],
            'fr' => $data['fr'],
            'en' => $data['en'],
        ]);

        return $language;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/delete_languages",
     *      tags={"Languages"},
     *     description="Delete language",
     *     security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"key"},
     *              @OA\Property(property="key", type="string", format="name"),
     *              )
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="bool"),
     *             @OA\Property(property="code", type="string"),
     *             @OA\Property(property="data",
     *                 @OA\Property(
     *                      property="key",
     *                      type="string",
     *                   )
     *             ),
     *             @OA\Property(property="message", type="string"),
     *            )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         ref="#/components/responses/Requestfails"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         ref="#/components/responses/TokenIvalid"
     *     ),
     *     @OA\Response(
     *         response=203,
     *         ref="#/components/responses/Permission"
     *     ),
     * )
     */


    public function delete_language(Request $request): JsonResponse
    {
        $validator = $this->delete_language_validator($request->all());
        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->sendError($errors->first(), $errors);
        }
        $input = $request->all();
        $this->language_delete($input);
        $success['key'] = $input['key'];
        return $this->sendResponse($success, 'Language deleted successfully');
    }

    protected function delete_language_validator(array $data)
    {
        return Validator::make($data, [
            'key' => ['required', 'string', 'exists:languages,key'],
        ]);
    }

    protected function language_delete(array $data)
    {
        Language::where('key', $data["key"])->delete();
    }

    //
    /**
     * @OA\Get(
     *     path="/api/v1/get_langs",
     *     summary="Get Lang",
     *      tags={"Languages"},
     *     description="Get Languase",
     *     @OA\Parameter(
     *         name="key",
     *         in="query",
     *         description="Get By Key",
     *         @OA\Schema(type="string")
     *     ),
     *      @OA\Parameter(
     *         name="app",
     *         in="query",
     *         description="Get By App",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="number",
     *         in="query",
     *         description="Number of items (default 20 if null)",
     *         @OA\Schema(type="number")
     *     ),
     *     @OA\Parameter(
     *         name="start",
     *         in="query",
     *         description="start default(0)",
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
     *             @OA\Property(
     *                 property="languages",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="language",
     *                         type="object",
     *                         ref="#/components/schemas/Language"
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
    public function get_langs(Request $request)
    {
        $start = $request->has('start') ? intval($request->input('start')) : 0;
        $number = $request->has('number') ? intval($request->input('number')) : 20;
        $query = Language::select('*');

        if ($request->has('key') && $request->key != null) {
            $query = $query->where('key', $request->key);
        }
        if ($request->has('app') && $request->app != null) {
            $query->where('app', $request->app);
        }

        $product = $query->skip($start)->limit($number)->get();

        $success['count'] = $query->count();

        $success["languages"] = $product;

        return $this->sendResponse($success, 'Languages retrived successfully');
    }

    /**
     * @OA\Post(
     *     path="/api/v1/update_language",
     *     summary="Update Language",
     *     description="Update Language",
     *     security={{"bearerAuth":{}}},
     *      tags={"Languages"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"key"},
     *              @OA\Property(property="key", type="string", format="text"),
     *              @OA\Property(property="fr", type="string", format="text"),
     *              @OA\Property(property="en", type="string", format="text"),
     *              )
     *          )
     *      ),
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="bool"),
     *             @OA\Property(property="code", type="string"),
     *             @OA\Property(property="data",
     *                 type="object",
     *                 @OA\Property(
     *                      property="language",
     *                      type="object",
     *                      ref="#/components/schemas/Language"
     *                   )
     *             ),
     *             @OA\Property(property="message", type="string"),
     *            )
     *     ),
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



    public function update_language(Request $request): JsonResponse
    {
        $validator = $this->update_language_validator($request->all());
        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->sendError($errors->first(), $errors);
        }

        $allinput = $request->all();
        unset($allinput['key']);
        Language::where("key", $request->key)->update($allinput);
        $success['language'] = new LanguageResource(Language::where("key", $request->key)->first());
        return $this->sendResponse($success, 'Language updated successfully');
    }

    protected function update_language_validator(array $data)
    {
        return Validator::make($data, [
            'key' => ['required', 'exists:languages,key'],
        ]);
    }
}
