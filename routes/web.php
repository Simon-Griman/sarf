<?php

use App\Http\Controllers\CintilloController;
use App\Http\Controllers\PdfResumenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumenController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', function() {
        return view('home');
    })->name('home');

    Route::resource('/resumen', ResumenController::class)->except('show', 'store', 'destroy')->names('resumen')->middleware('permission:resumen.index|resumen.create|resumen.edit|resumen.destroy');

    Route::get('/resumen-pdf/{id}', [PdfResumenController::class, 'generarDocumento'])->name('resumen-pdf');

    Route::resource('/users', UserController::class)->except('show', 'store', 'destroy')->names('users')->middleware('permission:users.index|users.create|users.edit|users.destroy');

    Route::resource('/roles', RoleController::class);

    Route::get('/cintillos', CintilloController::class)->name('cintillos');
});

require __DIR__.'/auth.php';
