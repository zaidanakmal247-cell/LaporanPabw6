<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return redirect()->route(Auth::check() ? 'laporan.create' : 'login');
});

Route::get('/lapor', [LaporanController::class, 'create'])->name('laporan.create');
Route::post('/lapor', [LaporanController::class, 'store'])->name('lapor.kirim');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/daftar-laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/profil-petugas', [LoginController::class, 'profile'])->name('petugas.profile');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
});