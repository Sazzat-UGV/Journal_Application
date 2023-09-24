<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SemesterController;
use App\Http\Controllers\Backend\SystemAdminController;
use App\Http\Controllers\Frontend\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('')->group(function () {
    /*home page route */
    Route::get('/', [HomeController::class, 'homePage'])->name('homePage');

    /*registration route*/
    Route::get('registration', [AuthLoginController::class, 'registrationPage'])->name('home.registrationPage');
    Route::post('registration', [AuthLoginController::class, 'registration'])->name('home.registration');

    /*login route*/
    Route::get('login', [AuthLoginController::class, 'loginPage'])->name('home.loginPage');
    Route::post('login', [AuthLoginController::class, 'login'])->name('home.login');

    /*user route*/
    Route::get('logout', [AuthLoginController::class, 'logout'])->name('user.logout');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
});




/*admin auth route*/
Route::prefix('admin')->group(function () {

    /*admin login route*/
    Route::get('login', [LoginController::class, 'loginPage'])->name('admin.loginPage');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

    /*admin change password route*/
    Route::get('change_password', [AdminController::class, 'changePasswordPage'])->name('admin.changepasswordpage');
    Route::post('change_password', [AdminController::class, 'changePassword'])->name('admin.changepassword');

    /*admin profile route*/
    Route::get('profile', [AdminController::class, 'profilePage'])->name('admin.profilePage');
    Route::put('update/profile/image/{id}', [AdminController::class, 'saveImage'])->name('admin.saveImage');
    Route::get('change/profile', [AdminController::class, 'changeProfilePage'])->name('admin.changeProfilePage');
    Route::put('update/profile/{id}', [AdminController::class, 'changeProfile'])->name('admin.changeProfile');

    /*admin dashboard*/
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    /*resource controller*/
    Route::resource('systemadmin', SystemAdminController::class);
    Route::resource('role', RoleController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('semester', SemesterController::class);

    /*Ajax call*/
    Route::get('/check/is_active/{id}', [SystemAdminController::class, 'changeStatus'])->name('admin.changeStatus');
    Route::get('/check/department/is_active/{id}', [DepartmentController::class, 'changeStatus'])->name('admin.changeStatus');
    Route::get('/check/semester/is_active/{id}', [SemesterController::class, 'changeStatus'])->name('admin.changeStatus');
});
