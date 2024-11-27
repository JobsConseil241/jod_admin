<?php

use App\Http\Controllers\Api\V1\PrivilegeController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User type Route
Route::get('/user-types', [UserTypeController::class, 'index']);

// Privileges CRUD route with apiRessources
Route::apiResource('privileges', PrivilegeController::class);

// Roles CRUD route with api Ressources
Route::apiResource('roles', RoleController::class);

Route::post('/privileges/{privilege}/roles', [PrivilegeController::class, 'assign']);
Route::delete('/privileges/{privilege}/roles/{role}', [PrivilegeController::class, 'remove']);


Route::get('/test', function (Request $request) {
   return 'API WORK';
});


