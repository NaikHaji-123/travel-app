<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pendaftaran;
use App\Models\PaketTravel;
use App\Models\Booking;
use App\Models\Transaksi;

class JamaahDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $pendaftaran = Pendaftaran::with('paketTravel')
            ->where('user_id', $user->id)
            ->whereIn('status', ['Pending', 'Lunas'])
            ->latest()
            ->first();

        if (!$pendaftaran) {
            $pendaftaran = Booking::with('paketTravel')
                ->where('user_id', $user->id)
                ->where('status', 'acc')
                ->latest()
                ->first();
        }

        $totalPembayaran = Transaksi::where('user_id', $user->id)
            ->where('status', 'acc')
            ->sum('jumlah');

        $riwayatPendaftaran = Pendaftaran::with('paketTravel')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $riwayatBooking = Booking::with('paketTravel')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $riwayat = $riwayatPendaftaran->concat($riwayatBooking)->sortByDesc('created_at');
        $pakets = PaketTravel::all();

        return view('jamaah.dashboard_jamaah', compact(
            'user',
            'pendaftaran',
            'riwayat',
            'pakets',
            'totalPembayaran'
        ));
    }

    // ⬇️ ini harus di luar function index()
   public function showTransaksi($id)
{
    $transaksi = Transaksi::with(['pendaftaran.paketTravel', 'booking'])
        ->findOrFail($id);

    return view('jamaah.transaksi-detail', compact('transaksi'));
}

}
