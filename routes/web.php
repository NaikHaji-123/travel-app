<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\JamaahDashboardController;
use App\Http\Controllers\AdminController;


// =======================
// HALAMAN UTAMA & UMUM
// =======================
Route::get('/', function () {
    return view('jamaah.halamanutama');
})->name('home');

// booking hanya bisa diakses kalau sudah login
Route::get('/booking', function () {
    return view('jamaah.booking');
})->middleware('auth')->name('booking');

// =======================
// AUTH (REGISTER, LOGIN, LOGOUT)
// =======================
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =======================
// JAMAAH (khusus role jamaah)
// =======================
Route::middleware(['auth', 'jamaah'])->group(function () {
    Route::get('/jamaah/dashboard', [JamaahDashboardController::class, 'index'])->name('jamaah.dashboard');

    Route::get('/jamaah/portal', function () {
        return view('jamaah.portal');
    })->name('jamaah.portal');

    // daftar paket / booking
    Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
});

// =======================
// ADMIN (khusus role admin)
// =======================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/admin/pendaftar', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/admin/pendaftar/{id}/verifikasi', [PendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');
});

// =======================
// PAKET HAJI & UMRAH
// =======================
Route::get('/paket-umrah-reguler', fn() => view('jamaah.paketumrahreguler'))->name('paket.umrah.reguler');
Route::get('/paket-umrah-turki', fn() => view('jamaah.paketumrahturki'))->name('paket.umrah.turki');
Route::get('/paket-haji-khusus', fn() => view('jamaah.pakethajikhusus'))->name('paket.haji.khusus');
Route::get('/paket-umrah-ramadhan', fn() => view('jamaah.paketumrahramadhan'))->name('paket.umrah.ramadhan');

use App\Http\Controllers\BookingController;

Route::middleware(['auth'])->group(function () {
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});
// Admin - Paket
Route::put('/admin/paket/{id}', [AdminController::class, 'updatePaket'])->name('paket.update');
Route::delete('/admin/paket/{id}', [AdminController::class, 'destroyPaket'])->name('paket.destroy');

// Admin - Jamaah
Route::put('/admin/jamaah/{id}', [AdminController::class, 'updateJamaah'])->name('jamaah.update');
Route::delete('/admin/jamaah/{id}', [AdminController::class, 'destroyJamaah'])->name('jamaah.destroy');

use App\Http\Controllers\PaketController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/paket', PaketController::class);
});
 // Form daftar berdasarkan paket tertentu
Route::get('/pendaftaran/{paket}', [PendaftaranController::class, 'create'])
    ->name('pendaftaran.create');
// routes/web.php
Route::resource('paket', PaketController::class);
Route::resource('jamaah', JamaahController::class);


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::put('/admin/booking/{id}', [AdminController::class, 'updateBooking'])->name('booking.update');
    Route::put('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
});

Route::resource('paket', PaketController::class);
