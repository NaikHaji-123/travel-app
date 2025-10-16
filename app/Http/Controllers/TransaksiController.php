<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // 📋 Tampilkan semua transaksi (khusus admin)
    public function index()
    {
        $transaksis = Transaksi::with(['user', 'pendaftaran'])->get();
        return view('admin.transaksi.index', compact('transaksis'));
    }

    // 💾 Simpan transaksi baru (misal setelah pendaftaran disetujui)
    public function store(Request $request)
    {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftarans,id',
            'jumlah' => 'required|numeric|min:0',
        ]);

        Transaksi::create([
            'user_id' => Auth::id(),
            'pendaftaran_id' => $request->pendaftaran_id,
            'jumlah' => $request->jumlah,
            'status' => 'pending',
            'jenis_pembayaran' => 'dp', // defaultnya DP
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil dibuat dan menunggu konfirmasi.');
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

    // 💰 Update nominal transaksi
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
