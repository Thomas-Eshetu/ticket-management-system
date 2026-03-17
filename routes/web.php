<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchasingController;

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

Route::get('/admin-viewTicket', [AdminController::class, 'viewTickets'])->name('admin.viewTicket')->middleware('role:admin');
Route::get('/admin-editTicket/{id}', [AdminController::class, 'editTicketView'])->name('admin.editTicket')->middleware('role:admin');
Route::post('/admin-updateTicket/{id}', [AdminController::class, 'updateTicket'])->name('ticket.update')->middleware('role:admin');



/***Staff Routes */
Route::get('/staff-dashboard', [StaffController::class, 'staffDashboard']) ->middleware('role:staff')->name('staffDashboard');
Route::get('/staff-createTicket', [StaffController::class, 'createTicketView'])->middleware('role:staff')->name('createTicket');
Route::get('/staff-viewTicket', [StaffController::class, 'viewTicketView'])->middleware('role:staff')->name(name: 'viewTicket');
Route::post('/staff/create-ticket',[StaffController::class, 'createTicket'])->name('ticket.create')->middleware('role:staff');
Route::get('/staff-viewProfile', [StaffController::class, 'profileView'])->middleware('role:staff')->name(name: 'staff.profile');
Route::post('/staff/change-password',[StaffController::class, 'changePassword'])->name('staff.changePassword')->middleware('role:staff');
Route::post('/staff/update-profile',[StaffController::class, 'updateProfile'])->name('staff.updateProfile')->middleware('role:staff');



/*** Auth Routes*/
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


/***Purchasing Routes */
Route::get('/purchasing/purchaser',[PurchasingController::class, 'viewPurchaser'])->name('view.purchaser');
Route::get('/purchasing/supplier',[PurchasingController::class, 'viewSupplier'])->name('view.supplier');
Route::get('/purchasing/product',[PurchasingController::class, 'viewProduct'])->name('view.product');
Route::get('/purchasing/purchase',[PurchasingController::class, 'viewPurchase'])->name('view.purchase');
Route::get('/purchasing/addSupplier',[PurchasingController::class, 'viewAddSupplier'])->name('view.addSupplier');
Route::post('/purchasing/saveSupplier',[PurchasingController::class, 'addSupplier'])->name('supplier.save');
Route::get('/purchasing/addProduct',[PurchasingController::class, 'viewAddProduct'])->name('view.addProduct');
Route::post('/purchasing/saveProduct',[PurchasingController::class, 'addProduct'])->name('product.save');
Route::get('/purchasing/addPurchase',[PurchasingController::class, 'viewAddPurchase'])->name('view.addPurchase');
Route::post('/purchasing/savePurchase',[PurchasingController::class, 'addPurchase'])->name('purchase.save');
Route::get('/purchasing-editPurchase/{id}', [PurchasingController::class, 'editPurchaseView'])->name('purchase.edit');
Route::post('/purchasing-updatePurchase/{id}', [PurchasingController::class, 'updatePurchase'])->name('purchase.update');