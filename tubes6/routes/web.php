<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParkController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [ParkController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [ParkController::class, 'dashboard']);

    Route::get('/reservasi', [ParkController::class, 'reservasi'])->name('reservasi.index');
    Route::post('/reservasi', [ParkController::class, 'storeReservasi'])->name('reservasi.store');

    Route::get('/denda', [ParkController::class, 'denda'])->name('denda.index');
});
