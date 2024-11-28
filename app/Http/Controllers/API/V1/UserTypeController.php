<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\UserType;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserTypeController extends BaseController
{

    //
    /**
     * @OA\Get(
     *     path="/api/v1/get_user_types",
     *     summary="Get All User Types",
     *      tags={"UserType"},
     *     description="Get All UserTypes",
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
     *                 property="usertypes",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="usertype",
     *                         type="object",
     *                         ref="#/components/schemas/UserType"
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

    public function get_user_types()
    {
        try {
            Log::info('Get users types Endpoint Entered.');
            $data['count'] = UserType::count();
            $data['usertypes'] = UserType::all();
            Log::debug('Get users types Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Usertypes retrieve successfully");
        } catch (Exception $e) {
            Log::error('Get users types Endpoint - Exception: ' . $e);
            return $this->sendError("Unexpected error occurred, please try again later.");
        } finally {
            Log::info('Get users types Endpoint Exited.');
        }
    }
}
