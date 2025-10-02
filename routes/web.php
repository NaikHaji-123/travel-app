<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\JamaahDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Models\PaketTravel; // ✅ Jangan lupa import model

// =======================
// RESOURCE PAKET & JAMAAH
// =======================
Route::resource('paket', PaketController::class)->except(['index','create','edit','show']);
Route::resource('jamaah', JamaahController::class)->except(['index','create','edit','show']);

// =======================
// HALAMAN UMUM
// =======================
Route::get('/', function () {
    $pakets = PaketTravel::all(); // ✅ Ambil semua paket
    return view('jamaah.halamanutama', compact('pakets'));
})->name('home');

Route::get('/booking', fn() => view('jamaah.booking'))
    ->middleware('auth')
    ->name('booking');

// =======================
// AUTH
// =======================
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// =======================
// JAMAAH (role jamaah)
// =======================
Route::middleware(['auth', 'jamaah'])->group(function () {
    Route::get('/jamaah/dashboard', [JamaahDashboardController::class, 'index'])->name('jamaah.dashboard');
    Route::get('/jamaah/portal', fn() => view('jamaah.portal'))->name('jamaah.portal');

    // Daftar paket / booking
    Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
});

// =======================
// ADMIN (role admin)
// =======================
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Pendaftar
    Route::get('/admin/pendaftar', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/admin/pendaftar/{id}/verifikasi', [PendaftaranController::class, 'verifikasi'])->name('pendaftaran.verifikasi');

    // CRUD paket
    Route::post('/paket', [AdminController::class, 'storePaket'])->name('paket.store');
    Route::put('/paket/{id}', [AdminController::class, 'updatePaket'])->name('paket.update');
    Route::delete('/paket/{id}', [AdminController::class, 'destroyPaket'])->name('paket.destroy');

    // CRUD jamaah
    Route::post('/jamaah', [AdminController::class, 'storeJamaah'])->name('jamaah.store');
    Route::put('/jamaah/{id}', [AdminController::class, 'updateJamaah'])->name('jamaah.update');
    Route::delete('/jamaah/{id}', [AdminController::class, 'destroyJamaah'])->name('jamaah.destroy');

    // Booking ACC / Tolak
    Route::post('/admin/booking/{id}/acc', [AdminController::class, 'bookingAcc'])->name('admin.booking.acc');
    Route::post('/admin/booking/{id}/tolak', [AdminController::class, 'bookingTolak'])->name('admin.booking.tolak');

    // Invoice
    Route::get('/admin/invoice/{booking}', [InvoiceController::class, 'create'])->name('invoice.create');
});

// =======================
// PAKET HAJI & UMRAH (halaman statis)
// =======================
Route::get('/paket-umrah-reguler', fn() => view('jamaah.paketumrahreguler'))->name('paket.umrah.reguler');
Route::get('/paket-umrah-turki', fn() => view('jamaah.paketumrahturki'))->name('paket.umrah.turki');
Route::get('/paket-haji-khusus', fn() => view('jamaah.pakethajikhusus'))->name('paket.haji.khusus');
Route::get('/paket-umrah-ramadhan', fn() => view('jamaah.paketumrahramadhan'))->name('paket.umrah.ramadhan');

// =======================
// BOOKING
// =======================
Route::middleware(['auth'])->group(function () {
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
});
Route::post('/admin/ubah-password', [AdminController::class, 'ubahPassword'])->name('admin.ubahPassword');
