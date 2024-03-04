<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\BeverageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// User
Route::get('/all_users', [UserController::class, 'index'])->name('users');
Route::get('/create_user', [UserController::class, 'create'])->name('createUser');
Route::post('/store_user', [UserController::class, 'store'])->name('storeUser');
Route::get('/editUser/{id}', [UserController::class, 'edit'])->name('editUser');
Route::post('/updateUser/{id}', [UserController::class, 'update'])->name('updateUser');

// Admin
Route::get('/admin_login', [AdminController::class, 'create'])->name('admin_login');
Route::post('admin_store', [AdminController::class, 'store'])->name('admin_store');
Route::post('custom_login', [AdminController::class, 'customLogin'])->name('custom_login');
Route::get('admin/email/verify/', [VerificationController::class, 'verify'])->name('admin.verification.verify');

// Categories
Route::get('/all_categories', [CategoryController::class, 'index'])->name('all_categories');
Route::get('/add_category', [CategoryController::class, 'create'])->name('add_category');
Route::post('/store_category', [CategoryController::class, 'store'])->name('store_category');
Route::get('/edit_category/{id}', [CategoryController::class, 'edit'])->name('edit_category');
Route::post('/update_category/{id}', [CategoryController::class, 'update'])->name('update_category');
Route::get('/delete_category/{id}', [CategoryController::class, 'delete']);


// Beverages
Route::get('/all_beverages', [BeverageController::class,'index'])->name('all_beverages');
Route::get('/add_beverage', [BeverageController::class, 'create'])->name('add_beverage');
Route::post('/store_beverage', [BeverageController::class, 'store'])->name('store_beverage');
Route::get('/edit_beverage/{id}', [BeverageController::class, 'edit'])->name('edit_beverage');
Route::post('/update_beverage/{id}', [BeverageController::class, 'update'])->name('update_beverage');
Route::get('/delete_beverage/{id}', [BeverageController::class, 'delete']);

// Index
Route::get('/home_page', [CategoryController::class, 'showLeastCategory'])->middleware(['auth', 'verified'])->name('home_page');

// Messages
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/all_messages', [ContactController::class, 'index'])->name('all_messages');
Route::get('/show_message/{id}', [ContactController::class, 'show'])->name('show_message');
Route::get('/delete_message/{id}', [ContactController::class, 'delete']);
