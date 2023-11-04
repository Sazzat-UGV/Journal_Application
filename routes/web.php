<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SemesterController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SystemAdminController;
use App\Http\Controllers\Backend\UserManagementController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PublicationController as BackendPublicationController;
use App\Http\Controllers\Frontend\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ForgetPasswordController;
use App\Http\Controllers\Frontend\PublicationController;
use App\Http\Controllers\Frontend\SearchController;
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

    /*Forget Password */
    Route::get('forget-password', [ForgetPasswordController::class, 'forgetPasswordPage'])->name('home.forgetPasswordPage');
    Route::post('forget-password', [ForgetPasswordController::class, 'forgetPassword'])->name('home.forgetPassword');

    /*Reset Password */
    Route::get('reset-password/{token}', [ForgetPasswordController::class, 'resetPasswordPage'])->name('home.resetPasswordPage');
    Route::post('reset-password/{token}', [ForgetPasswordController::class, 'resetPassword'])->name('home.resetPassword');

    /*user route*/
    Route::get('logout', [AuthLoginController::class, 'logout'])->name('user.logout');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');

    /*edit profile route*/
    Route::get('editProfilePage', [UserController::class, 'editProfilePage'])->name('user.editProfilePage');
    Route::put('editProfile/{id}', [UserController::class, 'editProfile'])->name('user.editProfile');
    Route::put('editProfileimage/{id}', [UserController::class, 'editProfileimage'])->name('user.editProfileimage');

    /*change password route*/
    Route::get('change-password', [UserController::class, 'changePasswordPage'])->name('user.changePasswordPage');
    Route::post('change-password', [UserController::class, 'changePassword'])->name('user.changePassword');

    /*Publication route*/
    Route::get('publicaton-create', [PublicationController::class, 'create'])->name('user.PublicationCreate');
    Route::post('publicaton-create', [PublicationController::class, 'store'])->name('user.PublicationStore');
    Route::get('publicaton-index', [PublicationController::class, 'index'])->name('user.PublicationIndex');
    Route::get('user/view-pdf/{user_id}/{filename}', [PublicationController::class, 'showPDF'])->name('user.userManagementshowPDF');
    Route::get('active/{id}',[PublicationController::class,'paperActive'])->name('user.paperActive');

    /*search route */
    Route::post('search-result', [SearchController::class, 'homeSearch'])->name('home.search');
    Route::post('search-result-get', [SearchController::class, 'homeSearchGet'])->name('home.searchGet');
    ROute::get('search_details/{paper_id}',[SearchController::class,'details'])->name('home.search_details');
    Route::get('publisher-profile/{student_id}',[SearchController::class,'publisherProfile'])->name('home.publisherProfile');
    /*follow*/
    Route::get('follow/{student_id}',[SearchController::class,'follow'])->name('home.follow');
    Route::get('unfollow/{student_id}',[SearchController::class,'unfollow'])->name('home.unfollow');
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
    Route::resource('category', CategoryController::class);
    Route::resource('backup', BackupController::class)->only(['index', 'store', 'destroy']);
    Route::resource('publication', BackendPublicationController::class);

    /*Ajax call*/
    Route::get('/check/is_active/{id}', [SystemAdminController::class, 'changeStatus'])->name('admin.changeStatus');
    Route::get('/check/department/is_active/{id}', [DepartmentController::class, 'changeStatus'])->name('admin.changeStatus');
    Route::get('/check/semester/is_active/{id}', [SemesterController::class, 'changeStatus'])->name('admin.changeStatus');


    /*User Management Route*/
    Route::get('user', [UserManagementController::class, 'index'])->name('admin.userManagementIndex');
    Route::get('user/view-details/{id}', [UserManagementController::class, 'view'])->name('admin.userManagementView');
    Route::get('user/view-pdf/{user_id}/{filename}', [UserManagementController::class, 'showPDF'])->name('admin.userManagementshowPDF');
    Route::get('user/publication/view-pdf/{user_id}/{filename}', [BackendPublicationController::class, 'showPDF'])->name('admin.usershowPDF');
    Route::delete('user/delete/{id}', [UserManagementController::class, 'destroy'])->name('admin.userManagementDestroy');

    /*System setting route*/
    Route::get('mail-setting', [SettingController::class, 'mailSettingPage'])->name('admin.mailSettingPage');
    Route::post('mail-setting', [SettingController::class, 'mailSetting'])->name('admin.mailSetting');

    /*System backup route*/
    Route::get('/backup/download/{file_name}', [BackUpcontroller::class, 'download'])->name('admin.backupDownload');
});
