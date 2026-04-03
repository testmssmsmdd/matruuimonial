<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Middleware\CheckSuperAdmin;
use App\Http\Middleware\CheckAdmin;

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/profile/{id}',[HomeController::class, 'profile'])->name('user.profile');
Route::get('/user/{username}',[HomeController::class, 'userlist'])->name('user');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/change-password', [ChangePasswordController::class, 'changePassword'])->name('change-password');
Route::post('/change-password', [ChangePasswordController::class, 'updatePassword'])->name('update-password');
Route::get('/admin/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard.index')->middleware('auth');

Route::middleware([CheckSuperAdmin::class,'auth'])->group(function () {
    Route::get('/admin/list',[AdminHomeController::class,'list'])->name('admin.list');
    Route::get('/admin/add', [AdminHomeController::class, 'add'])->name('admin.add');
    Route::post('/admin/store', [AdminHomeController::class, 'store'])->name('admin.store');
    Route::get('/admin/edit/{id}',[AdminHomeController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [AdminHomeController::class, 'update'])->name('admin.update');
    Route::delete('/admin/destroy/{id}',[AdminHomeController::class, 'destroy'])->name('admin.destroy');
    Route::post('/admin/change_status/{id}',[AdminHomeController::class,'change_status'])->name('admin.change_status');
});


Route::middleware([CheckAdmin::class,'auth'])->group(function () {
    Route::get('/admin/profile',[AdminProfileController::class,'list'])->name('admin.profile.list');
    Route::get('/admin/profile/create', [AdminProfileController::class, 'create'])->name('admin.profile.create');
    Route::get('/admin/profile/{id}',[AdminProfileController::class,'details'])->name('admin.profile.details');
    Route::post('/admin/profile/store',[AdminProfileController::class, 'store'])->name('admin.profile.store');
    Route::get('admin/profile/edit/{id}',[AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('admin/profile/edit/{id}',[AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('admin/profile/delete_gallery_img/{id}',[AdminProfileController::class, 'deleteGalleryImg'])->name('admin.profile.delete_gallery_img');
    Route::delete('admin/profile/delete/{id}',[AdminProfileController::class, 'deleteProfile'])->name('admin.profile.delete_profile');
    Route::post('admin/profile/change_status/{id}',[AdminProfileController::class, 'changeStatus'])->name('admin.profile.change_status');
});


Route::get('/states', [AdminProfileController::class, 'states'])->name('admin.profile.states');
Route::get('/cities', [AdminProfileController::class, 'city'])->name('admin.profile.cities');
Route::get('/admin/profile/mosals',[AdminProfileController::class, 'mosals'])->name('admin.profile.mosals');
