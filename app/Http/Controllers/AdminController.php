<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PaketTravel;
use App\Models\Pendaftaran;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ========================
    // INDEX
    // ========================
    public function index()
    {
        // Memanggil dashboard
        return $this->dashboard();
    }

    // ========================
    // DASHBOARD
    // ========================
    public function dashboard()
    {
        // Ringkasan
        $totalPaket = PaketTravel::count();
        $totalPembayaran = Pendaftaran::where('status', 'lunas')->count();
        $totalJamaah = User::where('role', 'jamaah')->count();
        $pembayaranMenunggu = Pendaftaran::where('status', 'menunggu')->count();

        // Data untuk tabel
        $pakets = PaketTravel::orderBy('tanggal_berangkat', 'asc')->get();
        $pendaftarans = Pendaftaran::with(['user', 'paketTravel'])->get();
        $jamaah = User::where('role', 'jamaah')->get();
        $riwayatTransaksi = Pendaftaran::with(['user', 'paketTravel'])->latest()->take(10)->get();

        // Booking
        $bookings = Booking::latest()->get();

        return view('admin.dashboard', compact(
            'totalPaket',
            'totalPembayaran',
            'totalJamaah',
            'pembayaranMenunggu',
            'pakets',
            'pendaftarans',
            'jamaah',
            'riwayatTransaksi',
            'bookings'
        ));
    }

    // ========================
    // CRUD PAKET
    // ========================
    public function updatePaket(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'tanggal_berangkat' => 'required|date',
        ]);

        $paket = PaketTravel::findOrFail($id);
        $paket->update([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'tanggal_berangkat' => $request->tanggal_berangkat,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Paket berhasil diperbarui!');
    }

    public function destroyPaket($id)
    {
        $paket = PaketTravel::findOrFail($id);
        $paket->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Paket berhasil dihapus!');
    }

    // ========================
    // CRUD JAMAAH
    // ========================
    public function updateJamaah(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
        ]);

        $jamaah = User::findOrFail($id);
        $jamaah->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data Jamaah berhasil diperbarui!');
    }

    public function destroyJamaah($id)
    {
        $jamaah = User::findOrFail($id);
        $jamaah->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data Jamaah berhasil dihapus!');
    }
}
