<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::resource('cars', CarController::class);
Route::resource('users', UserController::class);

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
