<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;

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

// dashboard page
Route::get('dashboard', [HomeController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// assets admin page
Route::resource('asset', AssetController::class)->middleware('auth');
Route::resource('asset/product', ProductController::class)->middleware('auth');

// company admin page
Route::resource('company', CompanyController::class)->middleware('auth')->middleware('auth.admin');
Route::get('company/{company}/access', [CompanyController::class, 'userAccess'])
    ->name('company.access')
    ->middleware('auth')
    ->middleware('auth.admin');
Route::post('company/{company}/access', [CompanyController::class, 'grantAccess'])
    ->name('company.grantAccess')
    ->middleware('auth')
    ->middleware('auth.admin');
Route::delete('company/{company}/access/delete', [CompanyController::class, 'destroyAccess'])
    ->middleware('auth')
    ->middleware('auth.admin');

// category admin page
Route::resource('category', CategoryController::class)->middleware('auth')->middleware('auth.admin');

// unit admin page
Route::resource('unit', UnitController::class)->middleware('auth')->middleware('auth.admin');

// user admin page
Route::resource('user', UserController::class)->middleware('auth')->middleware('auth.admin');
Route::patch('user/{user}/disable', [UserController::class, 'disableUser'])->middleware('auth')->middleware('auth.admin');
Route::patch('user/{user}/enable', [UserController::class, 'enableUser'])->middleware('auth')->middleware('auth.admin');
