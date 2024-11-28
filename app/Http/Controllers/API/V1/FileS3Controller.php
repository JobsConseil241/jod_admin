<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(
 *    title="API AN",
 *    version="1.0",
 * )
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 * )
 * @OA\SecurityScheme(
 *     securityScheme="api-key",
 *     type="apiKey",
 *     in="header",
 *     name="api-key",
 *     description="Your Application API access key"
 * )
 * @OA\SecurityScheme(
 *     securityScheme="api-secret",
 *     type="apiKey",
 *     in="header",
 *     name="api-secret",
 *     description="Your Application API access key"
 * )
 * @OA\Components(
 *     @OA\Response(
 *         response="Requestfails",
 *         description="An error occured",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="bool"),
 *             @OA\Property(property="code", type="string"),
 *             @OA\Property(property="data",
 *                 type="object",
 *             ),
 *             @OA\Property(property="message", type="string"),
 *            )
 *         ),
 *     ),
 *     @OA\Response(
 *         response="TokenIvalid",
 *         description="Your Token is missing or invalid",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="bool"),
 *             @OA\Property(property="code", type="string"),
 *             @OA\Property(property="data",
 *                 type="object",
 *             ),
 *             @OA\Property(property="message", type="string"),
 *            )
 *         ),
 *     ),
 *     @OA\Response(
 *         response="Permission",
 *         description="You don't have permission to perform this request",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="bool"),
 *             @OA\Property(property="code", type="string"),
 *             @OA\Property(property="data",
 *                 type="object",
 *             ),
 *             @OA\Property(property="message", type="string"),
 *            )
 *         ),
 *     ),
 *     @OA\Response(
 *         response="ApplicationUnknown",
 *         description="Application unknown",
 *         @OA\JsonContent(
 *             @OA\Property(property="success", type="bool"),
 *             @OA\Property(property="code", type="string"),
 *             @OA\Property(property="data",
 *                 type="object",
 *             ),
 *             @OA\Property(property="message", type="string"),
 *            )
 *         ),
 *     ),
 *     // Define other components like schemas, parameters, etc.
 * )
 */


class FileS3Controller extends BaseController
{
    //
    public static function check_if_file_exist($path)
    {
        if (Storage::disk('s3')->exists($path)) {
            return true;
        } else {
            return false;
        }
    }

    public static function getMimeType($extension)
    {
        // Common file types mapping
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'zip' => 'application/zip',
            'txt' => 'text/plain',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'mp3' => 'audio/mpeg',
            'ogg' => 'audio/ogg',
            'wav' => 'audio/wav',
            'mp4' => 'video/mp4',
            'avi' => 'video/x-msvideo',
            'mpeg' => 'video/mpeg',
            'html' => 'text/html',
            'csv' => 'text/csv',
            'json' => 'application/json',
            'xml' => 'application/xml',
            // Add more as needed
        ];

        return $extension ?? 'octet-stream';
    }

    public static function upload_file($file, $directory = '/')
    {
        try {
            Log::info('Upload file Endpoint Entered.');

            Log::debug('Upload file Endpoint - All Params: ' . json_encode($file));
            $name = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs(
                $directory,
                $name,
                's3'
            );

            Log::debug('Upload file Endpoint - Response: ' . json_encode($path));
            return $path;
        } catch (Exception $e) {
            Log::error('Upload file Endpoint - Exception: ' . $e);
        } finally {
            Log::info('Upload file Endpoint Exited.');
        }
    }

    public static function download($path)
    {
        try {
            Log::info('Download file Endpoint Entered.');

            Log::debug('Download file Endpoint - All Params: ' . json_encode($path));

            if (Storage::disk('s3')->exists($path)) {

                $filePath = Storage::disk('s3')->path($path);
                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                $file = Storage::disk('s3')->get($path);

                // Set the appropriate content type based on the file extension
                $contentType = FileS3Controller::getMimeType($extension);

                // Set the headers for the response
                $headers = [
                    'Content-Type' => $contentType,
                    'Content-Disposition' => 'attachment; filename="' . basename($filePath) . '"',
                ];
                Log::debug('Download file Endpoint - Response: ' . json_encode($file));
                return response()->stream(
                    function () use ($file) {
                        echo $file;
                    },
                    200,
                    $headers
                );
            }
        } catch (Exception $e) {
            Log::error('Download file Endpoint - Exception: ' . $e);
        } finally {
            Log::info('Download file Endpoint Exited.');
        }
    }

    public static function delete($path)
    {
        try {
            Log::info('Delete file Endpoint Entered.');

            Log::debug('Delete file Endpoint - All Params: ' . json_encode($path));
            if (Storage::disk('s3')->exists($path)) {
                Storage::disk('s3')->delete($path);
                Log::debug('Delete file Endpoint - Response: ' . json_encode(true));
                return true;
            }
            Log::debug('Delete file Endpoint - Response: ' . json_encode(false));
            return false;
        } catch (Exception $e) {
            Log::error('Delete file Endpoint - Exception: ' . $e);
        } finally {
            Log::info('Delete file Endpoint Exited.');
        }
    }



    //
    /**
     * @OA\Post(
     *     path="/api/v1/upload_document_temp",
     *     summary="Upload document in temp folder",
     *     description="Upload document in temp folder",
     *      tags={"File"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *              required={"file"},
     *              @OA\Property(property="file",type="string",format="binary"),
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
     *                         property="path",
     *                         type="string",
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
    public function upload_document_temp(Request $request)
    {
        try {
            Log::info('Upload document temp file Endpoint Entered.');

            Log::debug('Upload document temp Endpoint - All Params: ' . json_encode($request->all()));
            $data_t = $request->all();
            $rules = [
                'file' => ['required', 'file', 'mimes:jpeg,png,pdf,docx,doc', 'max:1024'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return $this->sendError($errors->first(), $errors);
            }

            $data['path'] = FileS3Controller::upload_file($request->file, env('BUCKET_HOME_DIR') . "temp_file");
            Log::debug('Upload document temp Endpoint - Response: ' . json_encode($data));
            return $this->sendResponse($data, "Upload document temp successfully in Temp folder");
        } catch (Exception $e) {
            Log::error('Upload document temp Endpoint - Exception: ' . $e);
        } finally {
            Log::info('Upload document temp Endpoint Exited.');
        }
    }
}
