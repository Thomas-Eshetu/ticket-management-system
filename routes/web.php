<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin-dashboard', [AdminController::class, 'dashboard']);
Route::get('/add-user', [AdminController::class,'addUserView']);
Route::get('/view-user', [AdminController::class,'viewUserView']);
