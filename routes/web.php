<?php

use App\Http\Controllers\CargamentoController;
use App\Http\Controllers\CintilloController;
use App\Http\Controllers\ParcelaController;
use App\Http\Controllers\PdfCargamentoController;
use App\Http\Controllers\PdfResumenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumenController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    if (auth()->check()) {
        return redirect()->route('home');
    }

    return redirect()->route('login');
});

Route::get('forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', function() {
        return view('home');
    })->middleware('check.new.user')->name('home');

    Route::resource('/resumen', ResumenController::class)->only('index', 'create', 'edit')->middleware('check.new.user')->names('resumen');

    Route::resource('/cargamento', CargamentoController::class)->only('index', 'create', 'edit')->middleware('check.new.user')->names('cargamento');

    Route::get('/parcelas/create/{cargamento_id}', [ParcelaController::class, 'create'])->middleware('check.new.user')->name('parcelas.create');

    Route::get('/parcelas/edit/{id}', [ParcelaController::class, 'edit'])->middleware('check.new.user', 'permission:parcela.edit')->name('parcelas.edit');

    Route::get('/resumen-pdf/{id}', [PdfResumenController::class, 'generarDocumento'])->middleware('check.new.user')->name('resumen-pdf');

    Route::get('/cargamento-pdf/{id}', [PdfCargamentoController::class, 'generarDocumento'])->middleware('check.new.user')->name('cargamento-pdf');

    Route::resource('/users', UserController::class)->except('show', 'store', 'destroy')->middleware('check.new.user')->names('users');

    Route::resource('/roles', RoleController::class)->except('show')->middleware('check.new.user');

    Route::get('/cintillos', CintilloController::class)->name('cintillos')->middleware('permission:cintillos.index', 'check.new.user');

    Route::get('/sesiones', function() {
        return view('auditoria.sesiones');
    })->name('sesiones')->middleware('permission:auditoria.sesiones', 'check.new.user');

    Route::get('/creados', function() {
        return view('auditoria.creados');
    })->name('creados')->middleware('permission:auditoria.creados', 'check.new.user');

    Route::get('/editados', function() {
        return view('auditoria.editados');
    })->name('editados')->middleware('permission:auditoria.editados', 'check.new.user');

    Route::get('/eliminados', function() {
        return view('auditoria.eliminados');
    })->name('eliminados')->middleware('permission:auditoria.eliminados', 'check.new.user');

    Route::get('/nueva-clave', function() {
        return view('cambiar_clave');
    })->name('nueva-clave');

    Route::get('/reset-password', function() {
        return view('reset_password');
    })->name('reset-pass')->middleware('permission:reset-pass', 'check.new.user');

    Route::get('/origen', function() {
        return view('terminal.origen');
    })->name('origen')->middleware('permission:terminal.origen', 'check.new.user');

    Route::get('/destino', function() {
        return view('terminal.destino');
    })->name('destino')->middleware('permission:terminal.destino', 'check.new.user');

    Route::get('/producto', function() {
        return view('producto');
    })->name('producto')->middleware('permission:producto', 'check.new.user');

    Route::get('/validaciones', function() {
        return view('validaciones');
    })->name('validaciones')->middleware('permission:validaciones', 'check.new.user');

    Route::get('/ruta', function() {
        return view('ruta');
    })->name('ruta')->middleware('permission:ruta.index', 'check.new.user');

    Route::get('/el-rola-del-norte', function(){return view('rola');});
});

require __DIR__.'/auth.php';