<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // 📋 Tampilkan semua transaksi (khusus admin)
    public function index()
    {
        // Ambil data transaksi lengkap dengan relasi user, pendaftaran, dan paket travel
        $transaksis = Transaksi::with(['user', 'pendaftaran.paketTravel'])->get();

        // Tambahan: jumlah jamaah dan paket untuk ditampilkan di dashboard admin
        $jumlahJamaah = \App\Models\Jamaah::count();
        $jumlahPaket = \App\Models\PaketTravel::count();

        return view('admin.dashboard', compact('transaksis', 'jumlahJamaah', 'jumlahPaket'));
    }

    // 💾 Simpan transaksi baru (misal setelah pendaftaran disetujui)
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'jumlah' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // ✅ Import model Pendaftaran (pastikan sudah di atas)
        // Cari pendaftaran terakhir dari user terkait
        $pendaftaran = Pendaftaran::where('user_id', $request->user_id)
            ->latest()
            ->first();

        // Simpan transaksi baru
        Transaksi::create([
            'user_id' => $request->user_id,
            'pendaftaran_id' => $pendaftaran ? $pendaftaran->id : null, // relasi ke pendaftaran
            'jumlah' => $request->jumlah,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // ✅ Update status transaksi (Admin setujui / tolak)
    public function updateStatus(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui.');
    }

    // 💰 Update nominal transaksi (edit langsung)
    public function updateNominal(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|in:dp,tabungan,lunas',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->jumlah = $request->jumlah;
        $transaksi->jenis_pembayaran = $request->jenis_pembayaran;
        $transaksi->save();

        return back()->with('success', 'Nominal transaksi berhasil diperbarui.');
    }

    // ➕ Tambah nominal (tabungan / tambahan pembayaran)
    public function tambahNominal(Request $request, $id)
    {
        $request->validate([
            'tambah_jumlah' => 'required|numeric|min:1',
            'jenis_pembayaran' => 'required|in:tabungan,lunas',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->jumlah += $request->tambah_jumlah;
        $transaksi->jenis_pembayaran = $request->jenis_pembayaran;
        $transaksi->save();

        return back()->with('success', 'Nominal tambahan berhasil ditambahkan.');
    }

    // ❌ Hapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
