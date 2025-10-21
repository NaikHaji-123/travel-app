<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\PaketTravel;
use App\Models\Transaksi;

class JamaahDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil pendaftaran terakhir jamaah (kalau ada)
        $pendaftaran = Pendaftaran::with('paketTravel')
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        // Hitung total pembayaran dari semua transaksi berdasarkan pendaftaran
        $totalPembayaran = 0;
        if ($pendaftaran) {
           $totalPembayaran = Transaksi::where('user_id', $user->id)
    ->where('status', 'Lunas')
    ->sum('jumlah');

        }

        // Ambil semua riwayat pendaftaran jamaah
        $riwayat = Pendaftaran::with('paketTravel')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil 4 paket terbaru
        $pakets = PaketTravel::latest()->take(4)->get();

        return view('jamaah.dashboard', compact(
            'user',
            'pendaftaran',
            'totalPembayaran',
            'riwayat',
            'pakets'
        ));
    }

    // Detail transaksi
    public function showTransaksi($id)
    {
        $transaksi = Transaksi::with(['pendaftaran.paketTravel'])
            ->findOrFail($id);

        return view('jamaah.transaksi-detail', compact('transaksi'));
    }
}
