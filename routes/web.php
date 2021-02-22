<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminCustomerController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // return view('welcome');
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// profile Routes
Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('dashboard.profile');
Route::post('/dashboard/profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');
Route::post('/dashboard/password/update', [ProfileController::class, 'updatepassword'])->name('dashboard.password.update');


// Admin Routes
Route::get('/dashboard/adminlist', [AdminController::class, 'index'])->name('dashboard.adminlist');
Route::post('/dashboard/admin/create', [AdminController::class, 'create'])->name('dashboard.admin.create');
Route::post('/editadmin/{id}' , [AdminController::class , 'edit'])->name('admin.edit');
Route::get('/deleteadmin/{id}' , [AdminController::class , 'delete'])->name('admin.delete');


// Expense Route 
Route::get('/dashboard/expense', [ExpenseController::class, 'index'])->name('expense');
Route::post('/dashboard/expense/store', [ExpenseController::class, 'store'])->name('expense.store');
Route::post('/dashboard/expense/update/{id}', [ExpenseController::class, 'update'])->name('expense.update');
Route::get('/dashboard/expense/delete/{id}', [ExpenseController::class, 'delete'])->name('expense.delete');


// Package Route 
Route::get('/dashboard/package', [PackageController::class, 'index'])->name('package');
Route::post('/dashboard/package/store', [PackageController::class, 'store'])->name('package.store');
Route::post('/dashboard/package/update', [PackageController::class, 'update'])->name('package.update');
Route::get('/dashboard/package/delete/{id}', [PackageController::class, 'delete'])->name('package.delete');

// Admin Customer Routes
Route::get('/customer/alllist', [AdminCustomerController::class, 'customerall'])->name('customer.alllist');
Route::get('/customer/newlist', [AdminCustomerController::class, 'customernewlist'])->name('customer.newlist');
Route::get('/customer/activelist', [AdminCustomerController::class, 'customeractivelist'])->name('customer.activelist');
Route::get('/customer/inactivelist', [AdminCustomerController::class, 'customerinactivelist'])->name('customer.inactivelist');
Route::post('/customer/register', [AdminCustomerController::class, 'customerregister'])->name('customer.register');
Route::get('/customer/active/{id}', [AdminCustomerController::class, 'customeractive'])->name('customer.active');
Route::get('/customer/inactive/{id}', [AdminCustomerController::class, 'customerinactive'])->name('customer.inactive');
Route::get('/customer/delete/{id}', [AdminCustomerController::class, 'customerdelete'])->name('customer.delete');



// Customer Route 
Route::get('/registration/form', [CustomerController::class, 'index'])->name('registration.form');
Route::post('/customer/form/post', [CustomerController::class, 'store'])->name('customer.form.post');
