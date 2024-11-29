<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\LanguageController;
use App\Http\Controllers\Back\RoleController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\CarController;
use App\Http\Controllers\Front\CustomerController;
use App\Http\Controllers\WelcomeController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

set_time_limit(300);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [WelcomeController::class, 'index'])->name('home');

Route::get('/about', [WelcomeController::class, 'about'])->name('about');
Route::get('/cars', [CarController::class, 'index'])->name('cars');
Route::get('/car/{car}', [CarController::class, 'show'])->name('car');
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
    });
});
