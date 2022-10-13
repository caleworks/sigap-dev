<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AssetItemController;

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

// public search page
Route::get('/', [SearchController::class, 'index'])->name('home');

// login
Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [AuthController::class, 'authenticate'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function() {
    
    // dashboard page
    Route::get('dashboard', [HomeController::class, 'index'])
        ->name('dashboard');

    // mro stock admin page
    Route::resource('stock', StockController::class);
    Route::post('stock/restock', [StockController::class, 'restock'])->name('stock.restock');
    Route::post('stock/out', [StockController::class, 'stockout'])->name('stock.out');
    
    // assets admin page
    Route::resource('asset', AssetController::class);
    Route::resource('asset.item', AssetItemController::class)->shallow()->except('index', 'show');
    Route::patch('item/{item}/deletepdf', [AssetItemController::class, 'delete_pdf'])->name('delete_pdf');

    Route::middleware('auth.admin')->group(function() {

        // category admin page
        Route::resource('category', CategoryController::class);
        
        // unit admin page
        Route::resource('unit', UnitController::class);
        
        // user admin page
        Route::resource('user', UserController::class);
        Route::patch('user/{user}/disable', [UserController::class, 'disableUser']);
        Route::patch('user/{user}/enable', [UserController::class, 'enableUser']);
    });

}); 


