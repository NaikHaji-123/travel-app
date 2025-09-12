<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;

class JamaahDashboardController extends Controller
{
    public function index()
    {
        // Ambil user yang login
        $user = Auth::user();

        // Ambil data pendaftaran + paket + pembayaran dari user
        $pendaftaran = Pendaftaran::with(['paketTravel', 'pembayaran'])
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        // Ambil semua riwayat pendaftaran
        $riwayat = Pendaftaran::with('paketTravel')
            ->where('user_id', $user->id)
            ->get();

        // arahkan ke view dashboard_jamaah.blade.php
        return view('jamaah.dashboard_jamaah', compact('user', 'pendaftaran', 'riwayat'));
    }
}
