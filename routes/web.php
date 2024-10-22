<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'dashboard'])->middleware('auth')->name('dashboard');

Route::get('/countries', [LocationController::class, 'indexCountries'])->middleware('auth')->name('countries.index');
Route::post('/countries', [LocationController::class, 'storeCountry'])->middleware('auth')->name('countries.store');

Route::get('/countries/{country}/provinces', [LocationController::class, 'indexProvinces'])->middleware('auth')->name('provinces.index');
Route::post('/countries/{country}/provinces', [LocationController::class, 'storeProvince'])->middleware('auth')->name('provinces.store');