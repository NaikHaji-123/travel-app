<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\JamaahDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TestimoniController;

use App\Models\PaketTravel;
use App\Models\Testimoni;

// =======================
// RESOURCE PAKET & JAMAAH
// =======================
//Route::resource('paket', PaketController::class)->except(['index', 'create', 'edit', 'show']);
//Route::resource('jamaah', JamaahController::class)->except(['index', 'create', 'edit', 'show']);

// =======================
// HALAMAN UMUM
// =======================


Route::get('/paket/{id}', [PaketController::class, 'show'])->name('paket.show');


// Route::get('/booking', fn() => view('jamaah.booking'))
//     ->middleware('auth')
//     ->name('booking');

// =======================
// AUTH
// =======================
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/jamaah/transaksi/{id}', [App\Http\Controllers\JamaahDashboardController::class, 'showTransaksi'])
    ->name('jamaah.transaksi.show');


// =======================
// JAMAAH (role jamaah)
// =======================
Route::middleware(['auth', 'jamaah'])->group(function () {
    Route::get('/jamaah/dashboard', [JamaahDashboardController::class, 'index'])->name('jamaah.dashboard');
    Route::get('/jamaah/portal', fn() => view('jamaah.portal'))->name('jamaah.portal');

    // Daftar paket / booking
  Route::get('/pendaftaran/{paket}', [PendaftaranController::class, 'create'])->name('pendaftaran.form');
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

    // CRUD Paket
    Route::post('/paket', [AdminController::class, 'storePaket'])->name('paket.store');
    Route::put('/paket/{id}', [AdminController::class, 'updatePaket'])->name('paket.update');
    Route::delete('/paket/{id}', [AdminController::class, 'destroyPaket'])->name('paket.destroy');

    // CRUD Jamaah
    Route::post('/jamaah', [AdminController::class, 'storeJamaah'])->name('jamaah.store');
    Route::put('/jamaah/{id}', [AdminController::class, 'updateJamaah'])->name('jamaah.update');
    Route::delete('/jamaah/{id}', [AdminController::class, 'destroyJamaah'])->name('jamaah.destroy');

    // CRUD Karyawan
    Route::post('/karyawan', [AdminController::class, 'storeKaryawan'])->name('karyawan.store');
    Route::put('/karyawan/{id}', [AdminController::class, 'updateKaryawan'])->name('karyawan.update');
    Route::delete('/karyawan/{id}', [AdminController::class, 'destroyKaryawan'])->name('karyawan.destroy');

    // CRUD Agent
    Route::post('/agent', [AdminController::class, 'storeAgent'])->name('agent.store');
    Route::put('/agent/{id}', [AdminController::class, 'updateAgent'])->name('agent.update');
    Route::delete('/agent/{id}', [AdminController::class, 'destroyAgent'])->name('agent.destroy');
    // Pendaftaran ACC / Tolak
Route::post('/admin/pendaftaran/{id}/acc', [AdminController::class, 'accPendaftaran'])->name('admin.pendaftaran.acc');
Route::post('/admin/pendaftaran/{id}/tolak', [AdminController::class, 'tolakPendaftaran'])->name('admin.pendaftaran.tolak');

// INVOICE
Route::get('/admin/invoice/{pendaftaran}', [InvoiceController::class, 'create'])->name('invoice.create');

    // Ubah password admin
    Route::post('/admin/ubah-password', [AdminController::class, 'ubahPassword'])->name('admin.ubahPassword');

    Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/admin/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::post('/admin/transaksi/{id}/update-status', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
    Route::delete('/admin/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
});
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
// Route::middleware(['auth'])->group(function () {
//     Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
// });
Route::post('/transaksi/update-nominal/{id}', [TransaksiController::class, 'updateNominal'])->name('transaksi.updateNominal');
Route::post('/transaksi/tambah-nominal/{id}', [TransaksiController::class, 'tambahNominal'])->name('transaksi.tambahNominal');

// =======================
// TESTIMONI
// =======================
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
Route::get('/', function () {
    $pakets = PaketTravel::all();
    $testimonis = Testimoni::all(); // ✅ tambahkan ini
    return view('jamaah.halamanutama', compact('pakets', 'testimonis'));
})->name('home');
