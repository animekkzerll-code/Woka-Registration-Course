<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPendaftaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PricelistController;


Route::get('/', function () {
    return view('home');
    
})->name('home');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/about', function () {return view('about');})->name('about');
Route::get('/pricelist', [PricelistController::class, 'publicIndex'])->name('pricelist');




// Siswa
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/home', [SiswaController::class, 'index'])->name('home');
    Route::get('/profile', [SiswaController::class, 'profile'])->name('profile');
    Route::get('/pendaftaran', [PendaftaranController::class, 'index']) ->name('pendaftaran');
    Route::get('/pendaftaran/edit', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/update', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
    Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'detail'])->name('pendaftaran.detail');

    Route::get('/status', [PendaftaranController::class, 'status'])->name('status');    
    Route::get('/riwayat', [PendaftaranController::class, 'riwayatSiswa'])->name('riwayat');     
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/pendaftar', [AdminPendaftaranController::class, 'index'])->name('pendaftar.index');
    Route::get('/pendaftar/{id}/detail',
            [AdminPendaftaranController::class, 'detail']
        )->name('pendaftar.detail');
    Route::patch('/pendaftar/{id}/approve', [AdminPendaftaranController::class, 'approve'])->name('pendaftar.approve');
    Route::patch('/pendaftar/{id}/reject', [AdminPendaftaranController::class, 'reject'])->name('pendaftar.reject');
    Route::post('pendaftaran-toggle', [AdminDashboardController::class, 'togglePendaftaran'])->name('pendaftaran.toggle');
    Route::resource('pricelist', PricelistController::class)->names('pricelist');



});


