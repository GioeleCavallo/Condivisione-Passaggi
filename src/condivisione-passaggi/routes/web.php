<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
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

Route::get('/', [LoginController::class, 'index']);
Route::post('/checkLogin', [LoginController::class, 'checkLogin']);

Route::middleware('auth')->group(function () {
    Route::get('/homePage', [UserController::class, 'home']);
    Route::post('/addUser', [UserController::class, 'addUser']);
    Route::get('/admin', [UserController::class, 'admin']);
    Route::post('/updatePassword', [UserController::class, 'updatePassword']);
    
    Route::get('/cars', [CarController::class, 'index']);
    Route::get('/car/{targa}', [CarController::class, 'car']);
    Route::post('/updateCar', [CarController::class, 'updateCar']);
    Route::post('/addCar', [CarController::class, 'addCar']);
});

Route::post('/logout', [UserController::class, 'logout']);
