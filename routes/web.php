<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;


// HALAMAN UTAMA
Route::get('/', function () {
    return view('jamaah.halamanutama');
}); 

// HALAMAN BOOKING SEKARANG
Route::get('/booking', function () {
    return view('jamaah.booking');
})->name('booking');


// HALAMAN REGISTER JAMAAH
Route::get('/jamaah/register', [AuthController::class, 'showRegisterForm'])->name('register');



// LOGIN & LOGOUT
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// DASHBOARD & PENDAFTARAN (UNTUK JAMAAH)
Route::middleware(['auth'])->group(function () {
    Route::get('/jamaah/dashboard', function () {
        return view('dashboard_jamaah');
    })->name('jamaah.dashboard');
    Route::get('/jamaah/portal', function () {
    return view('jamaah.portal');
})->name('jamaah.portal');


    Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
});

// DASHBOARD & VERIFIKASI (UNTUK ADMIN)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard_admin');
    })->name('admin.dashboard');

    Route::get('/admin/pendaftar', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/admin/pendaftar/{id}/verifikasi', [PendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
});
