<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

/***Admin Routes */

Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->middleware('role:admin');
Route::get('/add-user', [AdminController::class, 'addUserView'])->middleware('role:admin');
Route::get('/view-user', [AdminController::class, 'viewUserView'])->middleware('role:admin');
Route::get('/edit-user/{id}', [AdminController::class, 'editUserView'])->middleware('role:admin');

Route::post('/staff/store', [AdminController::class, 'store'])->name('staff.store')->middleware('role:admin');
Route::get('/reset-password/{id}', [AdminController::class, 'resetPassword'])->name('reset.user')->middleware('role:admin');
Route::get('/deactive-user/{id}', [AdminController::class, 'deactivateUser'])->name('deactive.user')->middleware('role:admin');
Route::get('/active-user/{id}', [AdminController::class, 'activateUser'])->name('active.user')->middleware('role:admin');
Route::post('/update-user/{id}', [AdminController::class, 'update'])->name('staff.update')->middleware('role:admin');

/***Staff Routes */
Route::get('/staff-dashboard', [StaffController::class, 'staffDashboard']) ->middleware('role:staff')->name('staffDashboard');
Route::get('/staff-createTicket', [StaffController::class, 'createTicketView'])->middleware('role:staff')->name('createTicket');
Route::get('/staff-viewTicket', [StaffController::class, 'viewTicketView'])->middleware('role:staff')->name(name: 'viewTicket');
Route::post('/staff/create-ticket',[StaffController::class, 'createTicket'])->name('ticket.create')->middleware();

/*** Auth Routes*/
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');
