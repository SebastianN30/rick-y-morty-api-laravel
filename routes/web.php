<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\indexController;

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

/* Ruta para poder visualizar toda la base datos */
Route::get('/characters', [indexController::class, 'showData']);
Route::post('/characters', [indexController::class, 'insertData']);
Route::delete('/characters/{id}', [indexController::class, 'deleteData']);

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
