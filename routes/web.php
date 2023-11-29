<?php

use App\Http\Controllers\ApartamentoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoradorController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('apartamento')->group(function () {
        Route::get('/cadastro', [ApartamentoController::class, 'index'])->name('apartamento.cadastro');
        Route::post('/store', [ApartamentoController::class, 'store'])->name('apartamento.store');
    });

    Route::prefix('morador')->group(function () {
        Route::get('/cadastro', [MoradorController::class, 'index'])->name('morador.cadastro');
        Route::post('/store', [MoradorController::class, 'store'])->name('morador.store');
    });
});
