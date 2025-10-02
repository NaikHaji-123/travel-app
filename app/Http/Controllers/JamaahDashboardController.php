<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\PaketTravel;
use App\Models\Booking;

class JamaahDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pendaftaran aktif
        $pendaftaran = Pendaftaran::with(['paketTravel', 'pembayaran'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['Pending', 'Lunas'])
            ->latest()
            ->first();

        // Riwayat pendaftaran
        $riwayatPendaftaran = Pendaftaran::with('paketTravel')
            ->where('user_id', $user->id)
            ->orderBy('created_at','desc')
            ->get();

        // Riwayat booking
        $riwayatBooking = Booking::with('paketTravel')
            ->where('user_id', $user->id)
            ->orderBy('created_at','desc')
            ->get();

        // Gabungkan semua riwayat
        $riwayat = $riwayatPendaftaran->concat($riwayatBooking)->sortByDesc('created_at');

        // Semua paket
        $pakets = PaketTravel::all();

        return view('jamaah.dashboard_jamaah', compact('user', 'pendaftaran', 'riwayat', 'pakets'));
    }
}
