<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
})->name('welcome');


use App\Http\Controllers\ProductoController;

Route::resource('productos', ProductoController::class);

use App\Http\Controllers\UsuarioController;

Route::resource('usuarios', UsuarioController::class);

use App\Http\Controllers\CarroController;

Route::resource('carros', CarroController::class);

Route::get('/cache', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
});