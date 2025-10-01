<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\PaketTravel;

class JamaahDashboardController extends Controller
{
    public function index()
    {
        // Ambil user yang login
        $user = Auth::user();

        // Ambil pendaftaran aktif + paket + pembayaran
        $pendaftaran = Pendaftaran::with(['paketTravel', 'pembayaran'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['Pending', 'Lunas'])
            ->latest()
            ->first();

        // Ambil semua riwayat pendaftaran
        $riwayat = Pendaftaran::with('paketTravel')
            ->where('user_id', $user->id)
            ->orderBy('created_at','desc')
            ->get();

        // Ambil semua paket untuk ditampilkan di dashboard
        $pakets = PaketTravel::all();

        // arahkan ke view dashboard_jamaah.blade.php
        return view('jamaah.dashboard_jamaah', compact('user', 'pendaftaran', 'riwayat', 'pakets'));
    }
}
