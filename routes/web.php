<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Back\BookingController;
use App\Http\Controllers\Back\CarController as BackCarController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\LanguageController;
use App\Http\Controllers\Back\PanneController;
use App\Http\Controllers\Back\PaymentController;
use App\Http\Controllers\Back\RecouvrementController;
use App\Http\Controllers\Back\RoleController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\CarsController;
use App\Http\Controllers\Front\CustomerController;
use App\Http\Controllers\WelcomeController;
use \App\Http\Controllers\Front\BookingController as BookingFrontController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

set_time_limit(300);

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/home', [WelcomeController::class, 'index'])->name('home');

Route::get('/about', [WelcomeController::class, 'about'])->name('about');
Route::get('/cars', [CarsController::class, 'index'])->name('cars-list');
Route::get('/cars/{name}', [CarsController::class, 'show'])->name('car-details');
Route::post('/cars/{name}', [BookingFrontController::class, 'booking'])->name('car-details-save-resa');
Route::get('/contact', [WelcomeController::class, 'contact'])->name('contact');

Route::get('/complete-registration', [RegisterController::class, 'completeRegistration'])->name('complete.registration');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function ($id, $hash, Request $request) {
    $user = User::findOrFail($id);
    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }
    return redirect('/login');
})->middleware(['signed'])->name('verification.verify');

Auth::routes();

Route::get('log-out', function () {
    Auth::logout();
    return redirect('/login');
});


Route::middleware(['auth'])->group(function () {

    /*
    | Customer
    */

    //auth
    Route::post('/2fa', [LoginController::class, 'two_fa'])->name('2fa');
    Route::get('/profil', [CustomerController::class, 'index'])->name('profil');

    /*
    | Admlinistrateur
    */
    Route::prefix('backend')->group(function () {

        //dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //vehicules
        Route::get('cars', [BackCarController::class, 'index'])->name('backend.list.cars');
        Route::get('cars/ajax', [BackCarController::class, 'ajax_get_cars'])->name('backend.ajax.cars');
        Route::get('car/add', [BackCarController::class, 'add'])->name('backend.add.car');
        Route::get('car/view/{car}', [BackCarController::class, 'view'])->name('backend.view.car');
        Route::get('car/edit/{car}', [BackCarController::class, 'edit'])->name('backend.edit.car');
        Route::post('car/store', [BackCarController::class, 'store'])->name('backend.store.car');
        Route::post('car/update/{car}', [BackCarController::class, 'update'])->name('backend.update.car');

        //Pannes
        Route::get('car/pannes/{car}', [BackCarController::class, 'list_panne'])->name('backend.car.pannes.list');
        Route::post('car/pannes/{car}/assign', [BackCarController::class, 'assign_pannes'])->name('backend.assign.panne');
        Route::post('car/pannes/{car}/assign_update', [BackCarController::class, 'update_assign_pannes'])->name('backend.assign_update.panne');
        Route::delete('car/pannes/{car}/delete_update', [BackCarController::class, 'delete_assign_pannes'])->name('backend.assign_delete.panne');

        //Images
        Route::get('car/picture/{car}', [BackCarController::class, 'media'])->name('backend.picture.car');
        Route::post('car/picture/{car}', [BackCarController::class, 'update_media'])->name('backend.picture.update.car');

        //Etats
        Route::get('car/etats/{car}', [BackCarController::class, 'etats_list'])->name('backend.etats_list.car');
        Route::get('car/etat/{car}/{date}', [BackCarController::class, 'etat'])->name('backend.etat.car');
        Route::get('car/etat/{car}', [BackCarController::class, 'etat'])->name('backend.etat.car');
        Route::post('car/etat/{car}', [BackCarController::class, 'update_etat'])->name('backend.etat.update.car');
        Route::post('car/etat/{car}/{date}', [BackCarController::class, 'update_etat'])->name('backend.etat.update.date.car');

        //Panne gestion generale
        Route::get('pannes', [PanneController::class, 'index'])->name('backend.list.pannes');
        Route::post('panne/store', [PanneController::class, 'store'])->name('backend.store.panne');
        Route::post('panne/update/{car}', [PanneController::class, 'update'])->name('backend.update.panne');
//        Route::post('panne/assign/{car}', [BackCarController::class, 'assign_panne'])->name('backend.assign.panne');

        //categories panne
        Route::get('panne/categories', [PanneController::class, 'categories'])->name('backend.list.panne.categories');
        Route::post('panne/category/store', [PanneController::class, 'store_category'])->name('backend.store.panne.category');
        Route::post('panne/category/update/{car}', [PanneController::class, 'update_category'])->name('backend.update.panne.category');

        //categories
        Route::get('categories', [BackCarController::class, 'categories'])->name('backend.list.categories');
        Route::post('category/store', [BackCarController::class, 'store_category'])->name('backend.store.category');
        Route::post('category/update/{car}', [BackCarController::class, 'update_category'])->name('backend.update.category');

        //marques
        Route::get('marques', [BackCarController::class, 'marques'])->name('backend.list.marques');
        Route::post('marque/store', [BackCarController::class, 'store_marque'])->name('backend.store.marque');
        Route::post('marque/update/{car}', [BackCarController::class, 'update_marque'])->name('backend.update.marque');

        //user_type
        Route::get('user-types', [RoleController::class, 'userType'])->name('backend.list.user-type');

        //privilege
        Route::get('privileges', [RoleController::class, 'privileges'])->name('backend.list.privilege');

        //role
        Route::get('roles', [RoleController::class, 'index'])->name('backend.list.role');
        Route::post('role/delete/{_id}', [RoleController::class, 'update'])->name('backend.delete.role');
        Route::post('role', [RoleController::class, 'save'])->name('backend.store.role');
        Route::post('role/edit/{_id}', [RoleController::class, 'update'])->name('backend.update.role');
        Route::post('edit-role', [RoleController::class, 'edit'])->name('backend.edit.role');
        Route::get('delete-role/{role}', [RoleController::class, 'delete'])->name('backend.delete.role');
        Route::post('role-user', [RoleController::class, 'roleUser'])->name('backend.assign.role');
        Route::post('role-privilege', [RoleController::class, 'rolePrivilege'])->name('backend.assign.privilige');

        //user
        Route::get('list-users', [UserController::class, 'users'])->name('backend.list.user');
        Route::get('list-administrators', [UserController::class, 'administrators'])->name('backend.list.administrator');
        Route::post('user/create', [UserController::class, 'store'])->name('backend.user.create');
        Route::post('user/edit', [UserController::class, 'edit'])->name('backend.user.edit');
        Route::post('user/assign', [UserController::class, 'assign'])->name('backend.user.assign');
        Route::post('user/update/{user}', [UserController::class, 'update'])->name('backend.user.update');
        Route::get('user/detail/{user}', [UserController::class, 'detail_user'])->name('backend.user.detail');
        Route::post('user/assign-role', [UserController::class, 'assignRole'])->name('backend.user.assign.role');

        Route::post('reset2fa', [UserController::class, 'reset2fa'])->name('backend.reset2fa');

        //profil
        Route::get('profil', [UserController::class, 'profil'])->name('backend.profil.user');
        Route::post('profil/update', [UserController::class, 'updateProfil'])->name('backend.profil.update');

        //language
        Route::get('languages', [LanguageController::class, 'index'])->name('backend.list.language');
        Route::post('edit-language', [LanguageController::class, 'edit'])->name('backend.edit.language');
        Route::post('language', [LanguageController::class, 'store'])->name('backend.store.language');
        Route::post('language/{langage}', [LanguageController::class, 'update'])->name('backend.update.language');

        //Locations Management
        Route::get('booking/list', [BookingController::class, 'index'])->name('backend.booking.list');
        Route::get('booking/list/ajax', [BookingController::class, 'ajax_get_locations'])->name('backend.booking.ajax');
        Route::get('booking/add', [BookingController::class, 'add'])->name('backend.booking.add');

        Route::get('booking/detail/{reference}', [BookingController::class, 'get_detail_booking'])->name('backend.booking.details');

        Route::get('booking/detail/{reference}/edit', [BookingController::class, 'get_details_booking_edit'])->name('backend.booking.details.view');
        Route::post('booking/detail/{reference}/edit', [BookingController::class, 'get_details_booking'])->name('backend.booking.details.update.value');
//        Route::post('booking/detail/{reference}', [BookingController::class, 'add'])->name('backend.booking.add');
        Route::post('booking/add', [BookingController::class, 'Store'])->name('backend.booking.store');
        Route::get('booking/car/pannes/{voiture}/ajax', [BookingController::class, 'getPannesByVoiture'])->name('backend.booking.pannes.ajax');

        //recouvrements issues
        Route::resource('recouvrements', RecouvrementController::class);
        Route::get('recouvrement/list/ajax', [RecouvrementController::class, 'ajax_get_recouvrements'])->name('backend.recouvrement.ajax');
        Route::post('recouvrements/{recouvrement}/paiement', [RecouvrementController::class, 'enregistrerPaiement'])->name('recouvrements.paiement');

        //Paiements Management
        Route::get('paiements/list', [PaymentController::class, 'index'])->name('backend.paiements.list');
        Route::get('paiements/list/ajax', [PaymentController::class, 'ajax_get_paiements'])->name('backend.paiements.ajax');
    });
});
