<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Middleware\CheckSuperAdmin;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckAdminRole;
use App\Http\Middleware\CheckUser;

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/profiles',[HomeController::class, 'profiles'])->name('user.profiles');
Route::get('/profiles/{slug}',[HomeController::class, 'getProfile'])->name('user.getprofile');
Route::get('/profile/{id}',[HomeController::class, 'profile'])->name('user.profile');
Route::get('/user/favourite-profile', [UserProfileController::class, 'favourite_profile_list'])->name('user.favourite_profile')->middleware('auth');

Route::get('/user/{username}',[HomeController::class, 'userlist'])->name('user');

Route::post('/resend-verification-custom', function (Request $request) {
    $request->validate([
        'email' => ['required', 'email'],
    ]);
    $user = \App\Models\User::where('email', $request->email)->first();
    if ($user && $user->is_active == 0) {
        $user->sendEmailVerificationNotification();
        session()->forget('verify_email');
        return back()->with('status', 'Verification email sent!');
    }
    return back()->withErrors(['login' => 'Invalid request']);
})->name('custom.verify.resend');

Auth::routes(['verify' => true]);

Route::middleware(['auth',CheckUser::class,'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/create_profile', [UserProfileController::class, 'create_profile'])->name('users.create_profile');
    Route::post('/store_profie', [UserProfileController::class, 'store_profile'])->name('users.store_profile');
    Route::post('/update_profile/{id}', [UserProfileController::class, 'update_profile'])->name('users.update_profile');
    Route::delete('user/profile/delete_gallery_img/{id}',[UserProfileController::class, 'deleteGalleryImg'])->name('user.profile.delete_gallery_img');
    Route::post('/user/profile/favourite', [UserProfileController::class, 'favourite_profile'])->name('user.profile.favourite');
    Route::delete('/user/profile/delete/{id}', [UserProfileController::class, 'delete_profile'])->name('user.profile.delete_profile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('my-account', [DashboardController::class, 'my_account'])->name('my-account');
    Route::put('update-admin-account/{id}', [DashboardController::class, 'update_admin_account'])->name('update-admin-account');
    Route::get('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [ChangePasswordController::class, 'updatePassword'])->name('update-password');
});
Route::get('/admin/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard.index')->middleware([CheckAdminRole::class,'auth']);

Route::middleware(['auth', CheckSuperAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/list', [AdminHomeController::class,'list'])->name('list');
    Route::get('/add', [AdminHomeController::class, 'add'])->name('add');
    Route::post('/store', [AdminHomeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AdminHomeController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [AdminHomeController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [AdminHomeController::class, 'destroy'])->name('destroy');
    Route::post('/change_status/{id}', [AdminHomeController::class,'change_status'])->name('change_status');
});

Route::middleware(['auth', CheckAdmin::class])->prefix('admin/profile')->name('admin.profile.')->controller(AdminProfileController::class)->group(function () {
    Route::get('/', 'list')->name('list');
    Route::get('/create', 'create')->name('create');
    Route::get('/{id}', 'details')->name('details');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/edit/{id}', 'update')->name('update');
    Route::delete('/delete_gallery_img/{id}', 'deleteGalleryImg')->name('delete_gallery_img');
    Route::delete('/delete/{id}', 'deleteProfile')->name('delete_profile');
    Route::post('/change_status/{id}', 'changeStatus')->name('change_status');

});


Route::get('/states', [AdminProfileController::class, 'states'])->name('admin.profile.states');
Route::get('/cities', [AdminProfileController::class, 'city'])->name('admin.profile.cities');