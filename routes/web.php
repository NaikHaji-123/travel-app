<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;

// =======================
// HALAMAN UTAMA & UMUM
// =======================
// HALAMAN UTAMA
Route::get('/', function () {
    return view('jamaah.halamanutama');
})->name('home');

Route::get('/booking', function () {
    return view('jamaah.booking');
})->middleware('auth')->name('booking');

// =======================
// AUTH (REGISTER, LOGIN, LOGOUT)
// =======================
Route::get('/jamaah/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =======================
// JAMAAH
// =======================
Route::middleware(['auth'])->group(function () {
    Route::get('/jamaah/dashboard', function () {
        return view('jamaah.dashboard_jamaah');
    })->name('jamaah.dashboard');

    Route::get('/jamaah/portal', function () {
        return view('jamaah.portal');
    })->name('jamaah.portal');

    Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
});

// =======================
// ADMIN
// =======================
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/pendaftar', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/admin/pendaftar/{id}/verifikasi', [PendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
});

// =======================
// PAKET HAJI & UMRAH
// =======================
Route::get('/paket-umrah-reguler', function () {
    return view('jamaah.paketumrahreguler');
})->name('paket.umrah.reguler');

Route::get('/paket-umrah-turki', function () {
    return view('jamaah.paketumrahturki');
})->name('paket.umrah.turki');

Route::get('/paket-haji-khusus', function () {
    return view('jamaah.pakethajikhusus');
})->name('paket.haji.khusus');

Route::get('/paket-umrah-ramadhan', function () {
    return view('jamaah.paketumrahramadhan');
})->name('paket.umrah.ramadhan');
// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');