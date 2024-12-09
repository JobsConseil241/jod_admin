<?php

use App\Http\Controllers\Api\v1\CarController;
use App\Http\Controllers\Api\V1\CategorieController;
use App\Http\Controllers\Api\V1\LanguageController;
use App\Http\Controllers\Api\V1\MarqueController;
use App\Http\Controllers\Api\V1\PrivilegeController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\UserTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, HEAD, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Authorization, Content-Type, Accept');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the 'api' middleware group. Enjoy building your API!
|
*/


Route::get('/get_langs', [LanguageController::class, 'get_langs'])->name('API-GET-LANGS');

Route::get('/get_cars', [CarController::class, 'get_Vehicules'])->name('API-GET-VEHICULES');

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
], function ($router) {

    //auth
    Route::post('/reset_2fa', [UserController::class, 'reset2fa']);
    Route::post('/resend_reset_password_notification', [UserController::class, 'resend_reset_password_notification']);

    //user_type
    Route::get('/get_user_type', [UserTypeController::class, 'get_user_types'])->name('API-GET-USERTYPES');

    //privilege
    Route::get('/get_privilege', [PrivilegeController::class, 'get_privilege'])->name('API-GET-PERMISSIONS');
    Route::post('/clear_privilege', [PrivilegeController::class, 'clear_privilege'])->name('API-CLEAR-PRIVILEGES');
    Route::post('/assign_privilege', [PrivilegeController::class, 'assign_privilege'])->name('API-ASSIGN-PRIVILEGE');
    Route::post('/remove_privilege', [PrivilegeController::class, 'remove_privilege'])->name('API-REMOVE-PRIVILEGE');

    //role
    Route::get('/get_roles', [RoleController::class, 'get_roles'])->name('API-GET-ROLES');
    Route::post('/add_role', [RoleController::class, 'add_role'])->name('API-ADD-ROLE');
    Route::post('/update_role', [RoleController::class, 'update_role'])->name('API-UPDATE-ROLE');
    Route::post('/delete_role', [RoleController::class, 'delete_role'])->name('API-DELETE-ROLE');
    Route::post('/assign_role', [RoleController::class, 'assign_role'])->name('API-ASSIGN-ROLE');
    Route::post('/remove_role', [RoleController::class, 'remove_role'])->name('API-REMOVE-ROLE');

    //user
    Route::get('/get_users', [UserController::class, 'get_users'])->name('API-GET-USER');
    Route::get('/get_user_datatable', [UserController::class, 'get_user_datatable'])->name('API-GET-USER-DATATABLE');
    Route::post('/add_user', [UserController::class, "add_user"])->name('API-ADD-USER');
    Route::post('/update_user', [UserController::class, 'update_user'])->name('API-UPDATE-USER');
    Route::post('/delete_user', [UserController::class, 'delete_user'])->name('API-DELETE-USER');

    //categories vehicules

    Route::get('/get_category_cars', [CategorieController::class, 'get_categories'])->name('API-GET-CATEGORIES-VEHICULES');
    Route::post('/add_category_cars', [CategorieController::class, 'add_category'])->name('API-ADD-CATEGORIES-VEHICULES');
    Route::patch('/update_category_cars', [CategorieController::class, 'edit_category'])->name('API-UPDATE-CATEGORIES-VEHICULES');
    Route::delete('/delete_category_cars', [CategorieController::class, 'delete_category'])->name('API-DELETE-CATEGORIES-VEHICULES');

    //marques vehicules
    Route::get('/get_brand_cars', [MarqueController::class, 'get_brands'])->name('API-GET-BRANDS-VEHICULES');
    Route::post('/add_brand_cars', [MarqueController::class, 'add_brand'])->name('API-ADD-BRANDS-VEHICULES');
    Route::patch('/update_brand_cars', [MarqueController::class, 'edit_brand'])->name('API-UPDATE-BRANDS-VEHICULES');
    Route::delete('/delete_brand_cars', [MarqueController::class, 'delete_brand'])->name('API-DELETE-BRANDS-VEHICULES');

    //vehicules
    Route::post('/add_cars', [CarController::class, 'add_Vehicule'])->name('API-ADD-VEHICULES');
    Route::patch('/update_cars', [CarController::class, 'edit_Vehicule'])->name('API-UPDATE-VEHICULES');
    Route::delete('/delete_cars', [CarController::class, 'delete_Vehicule'])->name('API-DELETE-VEHICULES');

    //language
    Route::post("/add_language", [LanguageController::class, "language_create"])->name('API-GET-LANGUAGE');
    Route::post("/update_language", [LanguageController::class, "update_language"])->name('API-UPDATE-LANGUAGE');
    Route::post("/delete_languages", [LanguageController::class, "delete_language"])->name('API-DELETE-LANGUAGE');
});
