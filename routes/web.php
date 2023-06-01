<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoadoresController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', [DoadoresController::class, 'index'])->name('doadores.index');
//Route::get('/doadores', [DoadoresController::class, 'index'])->name('doadores.index');
Route::get('/doadores/create', [DoadoresController::class, 'create'])->name('doadores.create');
Route::get('/doadores/edit', [DoadoresController::class, 'edit'])->name('doadores.edit');
Route::post('/doadores/save', [DoadoresController::class, 'save'])->name('doadores.save');
