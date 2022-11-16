<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;


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


Route::get('/', [ClientController::class, 'pageHome'])->name('home');
Route::post('/client/create', [ClientController::class, 'createClient'])->name('clientCreate');
Route::post('/client/{id}/add/car', [CarController::class, 'addCar'])->name('addCar');


Route::resource('/clients', ClientController::class)->names('clients');

Route::post('/clients/car', [CarController::class, 'selectCar']);
Route::post('/clients/car/check', [CarController::class, 'checkCar']);

Route::patch('/client/{id}/cars/update', [ClientController::class, 'updateCar'])->name('updateCar');
