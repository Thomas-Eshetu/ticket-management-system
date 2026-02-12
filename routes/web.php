<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

/***Admin Routes */

Route::get('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/add-user', [AdminController::class, 'addUserView']);
Route::get('/view-user', [AdminController::class, 'viewUserView']);
Route::get('/edit-user/{id}', [AdminController::class, 'editUserView']);

Route::post('/staff/store', [AdminController::class, 'store'])->name('staff.store');
Route::get('/reset-password/{id}', [AdminController::class, 'resetPassword'])->name('reset.user');
Route::get('/deactive-user/{id}', [AdminController::class, 'deactivateUser'])->name('deactive.user');
Route::get('/active-user/{id}', [AdminController::class, 'activateUser'])->name('active.user');
Route::post('/update-user/{id}', [AdminController::class, 'update'])->name('staff.update');

/***Staff Routes */
Route::get('/staff-dashboard', [StaffController::class, 'staffDashboard']);

/*** Auth Routes*/
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');
