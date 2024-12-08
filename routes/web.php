<?php

use App\Http\Controllers\MakalahController;
use App\Http\Controllers\PosterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Middleware untuk memastikan pengguna terautentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/posters', [PosterController::class, 'index'])->name('posters.index');
    Route::get('/posters/create', [PosterController::class, 'create'])->name('posters.create');
    Route::post('/posters/store', [PosterController::class, 'store'])->name('posters.store');
    Route::get('/posters/{id}', [PosterController::class, 'show'])->name('posters.show');
    Route::get('/posters/{id}/edit', [PosterController::class, 'edit'])->name('posters.edit');
    Route::put('/posters/{id}/update', [PosterController::class, 'update'])->name('posters.update');
    Route::delete('/posters/{id}/destroy', [PosterController::class, 'destroy'])->name('posters.destroy');

    Route::get('makalahs', [MakalahController::class, 'index'])->name('makalahs.index');
    Route::get('/makalahs/create', [MakalahController::class, 'create'])->name('makalahs.create');
    Route::post('/makalahs/store', [MakalahController::class, 'store'])->name('makalahs.store');
    Route::get('/makalahs/{id}', [MakalahController::class, 'show'])->name('makalahs.show');
    Route::get('/makalahs/{id}/edit', [MakalahController::class, 'edit'])->name('makalahs.edit');
    Route::put('/makalahs/{id}/update', [MakalahController::class, 'update'])->name('makalahs.update');
    Route::delete('/makalahs/{id}/destroy', [MakalahController::class, 'destroy'])->name('makalahs.destroy');
});

// Rute untuk pendaftaran dan login
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route dashboard (jika ada)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');