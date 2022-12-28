<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AdminController::class, 'index']);
Route::get('/login', [AdminController::class, 'viewLogin'])->name('login');
Route::post('/login', [AdminController::class, 'login']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::get('/dashboard', [AdminController::class, 'index']);

// Users
Route::get('/dashboard/users', [AdminController::class, 'usersIndex']);
Route::get('/dashboard/users/add', [AdminController::class, 'usersCreate']);
Route::post('/dashboard/users', [AdminController::class, 'usersStore']);
Route::delete('/dashboard/users/{user}', [AdminController::class, 'usersDestroy']);
Route::get('/dashboard/users/edit/{user}', [AdminController::class, 'usersEdit']);
Route::put('/dashboard/users/{user}', [AdminController::class, 'usersUpdate']);

// Cars
Route::get('/dashboard/cars', [AdminController::class, 'carsIndex']);
Route::delete('/dashboard/cars/{car}', [AdminController::class, 'carsDestroy']);