<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


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


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::post('/client/create', [MainController::class, 'createClient'])->name('clientCreate');
Route::post('/client/{id}/add/car', [MainController::class, 'addCar'])->name('addCar');


Route::resource('/clients', MainController::class)->names('clients');

Route::post('/clients/car', [HomeController::class, 'selectCar']);
Route::post('/clients/car/check', [HomeController::class, 'checkCar']);

Route::patch('/client/{id}/cars/update', [MainController::class, 'updateCar'])->name('updateCar');
