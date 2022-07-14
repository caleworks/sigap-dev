<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

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

// public search page
Route::get('/', [App\Http\Controllers\SearchController::class, 'index'])->name('home');

// login
Route::get('/login', [App\Http\Controllers\AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// dashboard page
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard')->middleware('auth');

//user admin page
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth');
//Route::get('/user/add', [App\Http\Controllers\UserController::class, 'add'])->middleware('auth');
Route::post('/user/add', [App\Http\Controllers\UserController::class, 'store_user'])->middleware('auth');