<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('layouts.admin');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin
Route::prefix('/admin')->middleware(['auth','isAdmin'])->group( function(){
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::controller(CategoryController::class)->group(function(){
        Route::get('category', 'index');
        Route::post('category',  'storeAdd');
        Route::get('category/{id}/edit', 'getDetail');
        Route::put('category/{data}/edit', 'edit');
        Route::get('category/{id}/showHide', 'update');
    });
});
