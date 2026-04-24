<?php

use App\Http\Controllers\CintilloController;
use App\Http\Controllers\PdfResumenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumenController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
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

    Route::resource('/resumen', ResumenController::class)->only('index', 'create', 'edit')->names('resumen');

    Route::get('/resumen-pdf/{id}', [PdfResumenController::class, 'generarDocumento'])->name('resumen-pdf');

    Route::resource('/users', UserController::class)->except('show', 'store', 'destroy')->names('users');

    Route::resource('/roles', RoleController::class)->except('show');

    Route::get('/cintillos', CintilloController::class)->name('cintillos')->middleware('permission:cintillos.index');

    Route::get('/sesiones', function() {
        return view('auditoria.sesiones');
    })->name('sesiones')->middleware('permission:auditoria.sesiones');

    Route::get('/creados', function() {
        return view('auditoria.creados');
    })->name('creados')->middleware('permission:auditoria.creados');

    Route::get('/editados', function() {
        return view('auditoria.editados');
    })->name('editados')->middleware('permission:auditoria.editados');

    Route::get('/eliminados', function() {
        return view('auditoria.eliminados');
    })->name('eliminados')->middleware('permission:auditoria.eliminados');

    Route::get('/el-rola-del-norte', function(){return view('rola');});
});

require __DIR__.'/auth.php';
