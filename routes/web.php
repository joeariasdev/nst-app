<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/user', UserController::class)->middleware(['auth']);

Route::resource('/client', ClientController::class)->middleware(['auth']);

Route::resource('/device', DeviceController::class)->middleware(['auth']);

Route::resource('/order', OrderController::class)->middleware(['auth'])->except(['destroy']);

require __DIR__ . '/auth.php';
