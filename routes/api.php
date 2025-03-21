<?php

use App\Http\Controllers\Api\V1\BookingController;
use App\Http\Controllers\Api\V1\CarController;
use App\Http\Controllers\Api\V1\CarPictureController;
use App\Http\Controllers\Api\V1\CategorieController;
use App\Http\Controllers\Api\V1\CategoriePanneController;
use App\Http\Controllers\Api\V1\EtatVehiculeController;
use App\Http\Controllers\Api\V1\LanguageController;
use App\Http\Controllers\Api\V1\MarqueController;
use App\Http\Controllers\Api\V1\PanneController;
use App\Http\Controllers\Api\V1\PaymentController;
use App\Http\Controllers\Api\V1\PrivilegeController;
use App\Http\Controllers\Api\V1\RecouvrementController;
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
Route::get('/get_cars_datatables', [CarController::class, 'get_cars_datatable'])->name('API-GET-DATATABLE-VEHICULES');

Route::group([
    'middleware' => ['api', 'auth:sanctum'],
], function ($router) {

    //auth
    Route::post('/reset_2fa', [UserController::class, 'reset2fa']);
    Route::post('/resend_reset_password_notification', [UserController::class, 'resend_reset_password_notification']);

    //user_type
    Route::get('/get_user_type', [UserTypeController::class, 'get_user_types'])->name('API-GET-USERTYPES');

    //get suppliers values
    Route::get('/get_suppliers', [UserController::class, 'get_supplier_users'])->name('API-SUPPLIER-USER');

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
    Route::get('/get_user_detail', [UserController::class, 'get_detail_user'])->name('API-GET-USER-DETAIL');
    Route::get('/get_user_datatable', [UserController::class, 'get_user_datatable'])->name('API-GET-USER-DATATABLE');
    Route::post('/add_user', [UserController::class, "add_user"])->name('API-ADD-USER');
    Route::post('/update_user', [UserController::class, 'update_user'])->name('API-UPDATE-USER');
    Route::post('/delete_user', [UserController::class, 'delete_user'])->name('API-DELETE-USER');

    //categories vehicules
    Route::get('/get_category_cars', [CategorieController::class, 'get_categories'])->name('API-GET-CATEGORIES-VEHICULES');
    Route::post('/add_category_cars', [CategorieController::class, 'add_category'])->name('API-ADD-CATEGORIES-VEHICULES');
    Route::post('/update_category_cars', [CategorieController::class, 'edit_category'])->name('API-UPDATE-CATEGORIES-VEHICULES');
    Route::delete('/delete_category_cars', [CategorieController::class, 'delete_category'])->name('API-DELETE-CATEGORIES-VEHICULES');

    //marques vehicules
    Route::get('/get_brand_cars', [MarqueController::class, 'get_brands'])->name('API-GET-BRANDS-VEHICULES');
    Route::post('/add_brand_cars', [MarqueController::class, 'add_brand'])->name('API-ADD-BRANDS-VEHICULES');
    Route::post('/update_brand_cars', [MarqueController::class, 'edit_brand'])->name('API-UPDATE-BRANDS-VEHICULES');
    Route::delete('/delete_brand_cars', [MarqueController::class, 'delete_brand'])->name('API-DELETE-BRANDS-VEHICULES');

    //vehicules
    Route::post('/add_cars', [CarController::class, 'add_Vehicule'])->name('API-ADD-VEHICULES');
    Route::post('/update_cars', [CarController::class, 'edit_Vehicule'])->name('API-UPDATE-VEHICULES');
    Route::delete('/delete_cars', [CarController::class, 'delete_Vehicule'])->name('API-DELETE-VEHICULES');

    // Photos du vehicules
    Route::post('/add_pictures_cars', [CarPictureController::class, 'add_Vehicule_Picture'])->name('API-ADD-PICTURES-VEHICULES');
    Route::delete('/delete_picture_cars', [CarPictureController::class, 'delete_single_Image'])->name('API-DELETE-PICTURES-VEHICULES');

    // Etat du vehicule
    Route::get('/get_state_of_car', [EtatVehiculeController::class, 'get_vehicule_etats'])->name('API-GET-STATE-OF-VEHICULE');
    Route::post('/set_state_of_cars', [EtatVehiculeController::class, 'add_etat_vehicule'])->name('API-ADD-STATE-OF-VEHICULES');
    Route::post('/update_state_of_cars', [EtatVehiculeController::class, 'edit_etat_vehicule'])->name('API-EDIT-STATE-OF-VEHICULES');
    Route::post('/delete_state_of_cars', [EtatVehiculeController::class, 'delete_etat_vehicule'])->name('API-DELETE-STATE-OF-VEHICULES');

    // Booking Process
    Route::get('/get_detail_reservation_car', [BookingController::class, 'getDetailBooking'])->name('API-GET-DETAILS-BOOKING-VEHICULE');
    Route::post('/set_reservation_cars', [BookingController::class, 'registerBookingBack'])->name('API-ADD-BOOKING-VEHICULES');
    Route::post('/update_reservation_cars', [BookingController::class, 'updateBooking'])->name('API-UPDATE-BOOKING-VEHICULES');
    Route::post('/validate_reservation_cars', [BookingController::class, 'validateBooking'])->name('API-VALIDATE-BOOKING-VEHICULES');
    Route::post('/reject_reservation_cars', [BookingController::class, 'rejectBooking'])->name('API-REJECT-BOOKING-VEHICULES');
    Route::post('/cancel_reservation_cars', [BookingController::class, 'cancelBooking'])->name('API-CANCEL-BOOKING-VEHICULES');
    Route::post('/assign_pannes_location', [BookingController::class, 'assign_pannes_locations'])->name('API-ASSIGN-PANNES-LOCATIONS');
    Route::post('/update_pannes_location', [BookingController::class, 'update_pannes_locations'])->name('API-UPDATE-PANNES-LOCATIONS');
    Route::delete('/delete_pannes_location', [BookingController::class, 'delete_pannes_locations'])->name('API-DELETE-PANNES-LOCATIONS');

    //Locations Pannes
    Route::get('/get_location_pannes', [PanneController::class, 'get_location_pannes'])->name('API-GET-ALL-PANNES-LOCATION');
    Route::post('/assign_pannes_location', [PanneController::class, 'assign_pannes_location'])->name('API-ASSIGN-PANNES-LOCATION');
    Route::post('/update_pannes_location', [PanneController::class, 'update_pannes_location'])->name('API-UPDATE-PANNES-LOCATION');
    Route::delete('/delete_pannes_location', [PanneController::class, 'delete_pannes_location'])->name('API-DELETE-PANNES-LOCATION');

    // Paiements Values
    Route::get('/get_all_paiements', [PaymentController::class, 'get_all_paiements'])->name('API-GET-ALL-PAYMENTS');

    // Recouvrements Values
    Route::get('/get_all_recouvrements', [RecouvrementController::class, 'get_all_recouvrements'])->name('API-GET-ALL-RECOUVREMENTS');

    // categories pannes
    Route::get('/get_category_pannes', [CategoriePanneController::class, 'get_categories_pannes'])->name('API-GET-CATEGORIES-PANNES');
    Route::post('/add_category_pannes', [CategoriePanneController::class, 'add_category_pannes'])->name('API-ADD-CATEGORIES-PANNES');
    Route::post('/update_category_pannes', [CategoriePanneController::class, 'edit_category_pannes'])->name('API-UPDATE-CATEGORIES-PANNES');
    Route::delete('/delete_category_pannes', [CategoriePanneController::class, 'delete_category_pannes'])->name('API-DELETE-CATEGORIES-PANNES');


    // Gestion des pannes
    Route::get('/get_pannes', [PanneController::class, 'get_all_pannes'])->name('API-GET-PANNES');
    Route::post('/add_pannes', [PanneController::class, 'add_pannes'])->name('API-ADD-PANNES');
    Route::post('/update_pannes', [PanneController::class, 'edit_pannes'])->name('API-UPDATE-PANNES');
    Route::delete('/delete_pannes', [PanneController::class, 'delete_pannes'])->name('API-DELETE-PANNES');
    Route::get('/get_all_vehicules_pannes', [PanneController::class, 'get_all_vehicules_pannes'])->name('API-GET-ALL-VEHICULES-PANNES');
    Route::get('/get_vehicule_pannes', [PanneController::class, 'get_vehicule_pannes'])->name('API-GET-ALL-PANNES-VEHICULE');
    Route::post('/assign_pannes_vehicule', [PanneController::class, 'assign_pannes_vehicules'])->name('API-ASSIGN-PANNES-VEHICULES');
    Route::post('/update_pannes_vehicule', [PanneController::class, 'update_pannes_vehicules'])->name('API-UPDATE-PANNES-VEHICULES');
    Route::delete('/delete_pannes_vehicule', [PanneController::class, 'delete_pannes_vehicules'])->name('API-DELETE-PANNES-VEHICULES');

    //language
    Route::post("/add_language", [LanguageController::class, "language_create"])->name('API-GET-LANGUAGE');
    Route::post("/update_language", [LanguageController::class, "update_language"])->name('API-UPDATE-LANGUAGE');
    Route::post("/delete_languages", [LanguageController::class, "delete_language"])->name('API-DELETE-LANGUAGE');

    //Booking Route
    Route::get("/get_all_locations", [BookingController::class, 'get_all_locations'])->name('API-GET-ALL-LOCATIONS');
});
