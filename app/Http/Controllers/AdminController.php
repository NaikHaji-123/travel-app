<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PaketTravel;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Angka ringkasan
        $totalPaket = PaketTravel::count();
        $totalPembayaran = Pendaftaran::where('status', 'lunas')->count();
        $totalJamaah = User::where('role', 'jamaah')->count();
        $pembayaranMenunggu = Pendaftaran::where('status', 'menunggu')->count();

        // Koleksi untuk tabel di view
        $pakets = PaketTravel::orderBy('tanggal_berangkat', 'asc')->get();
        $pendaftarans = Pendaftaran::with(['user', 'paketTravel', 'verifikasi'])->get();
        $jamaah = User::where('role', 'jamaah')->get();
        $riwayatTransaksi = Pendaftaran::with(['user', 'paketTravel'])->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalPaket',
            'totalPembayaran',
            'totalJamaah',
            'pembayaranMenunggu',
            'pakets',
            'pendaftarans',
            'jamaah',
            'riwayatTransaksi'
        ));
    }
}
