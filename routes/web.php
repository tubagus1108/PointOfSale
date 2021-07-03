<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('login',[AuthController::class, 'login'])->name('login');
Route::post('login',[AuthController::class, 'loginPost'])->name('login-post');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
// Route::group(['middleware' => 'auth'], function () {
    // Route::resource('roles', RoleController::class);
    Route::get('/',[DashboardController::class, 'index'])->name('main-dashboard');
    // Category
    Route::get('category',[CategoryController::class, 'index'])->name('main-category');
    Route::post('category',[CategoryController::class, 'store'])->name('main-category-post');
    Route::get('category-datatable',[CategoryController::class, 'categoryDatatable'])->name('category-datatable');
    Route::get('{id}/category-edit', [CategoryController::class, 'categoryEdit']);
    Route::post('category-edit-execute', [CategoryController::class, 'categoryEditExecute'])->name('category-edit-execute');
    Route::get('category-delete/{id}',[CategoryController::class, 'categoryDelete'])->name('category-delete');
    // Product
    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::post('products-post',[ProductController::class, 'store'])->name('main-products-post');
    Route::get('products-datatable',[ProductController::class, 'productsDatatable'])->name('main-products-datatable');
    Route::get('{id}/products-edit', [ProductController::class, 'prodcutsEdit']);
    Route::post('products-edit-execute', [ProductController::class, 'prodcutsEditExecute'])->name('products-edit-execute');
    Route::get('products-dalete/{id}', [ProductController::class, 'productsDelete'])->name('products-delete');
// });
