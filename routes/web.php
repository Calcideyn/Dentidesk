<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registro;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 

Route::get('/', function () {
    return view('index');
});
*/
Route::get('/', [Registro::class, 'index'])->name('Inicio');
Route::post('/Registrar', [Registro::class, 'create'])->name('Registrar');