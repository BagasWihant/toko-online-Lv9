<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\User\MarketController;

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

// Market untuk user umum 
Route::controller(MarketController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/semua-kategori', 'semuaKategori')->name('semua-kategori');
});
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin
Route::prefix('/admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'index')->name('category');
    });

    Route::controller(ProdukController::class)->group(function () {
        Route::get('product', 'index')->name('product');
    });
    
    Route::get('slider', [SliderController::class,'index'])->name('slider');
});
