<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\PaketTravel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PendaftaranController extends Controller
{
    // 📋 Tampilkan semua pendaftaran (khusus admin)
    public function index()
    {
        $pendaftarans = Pendaftaran::with(['user', 'paketTravel', 'verifikasi'])->get();
        return view('pendaftaran.index', compact('pendaftarans'));
    }

    // 📌 Form pendaftaran dari dashboard Jamaah
    public function create($paket_id)
    {
        $paket = PaketTravel::findOrFail($paket_id);
        $user = auth()->user();
        return view('jamaah.booking', compact('user', 'paket'));
    }

    // 💾 Simpan pendaftaran baru
    public function store(Request $request)
    {
        $request->validate([
            'paket_travel_id' => 'required',
            'ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 🔍 Cegah user daftar dua kali sebelum disetujui
        $cekPendaftaran = Pendaftaran::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'proses'])
            ->first();

        if ($cekPendaftaran) {
            return redirect()->back()->with('error', 'Anda masih memiliki pendaftaran yang belum disetujui.');
        }

        try {
            // 📂 Upload file
            $ktp = $request->file('ktp')->store('uploads/ktp', 'public');
            $kk = $request->file('kk')->store('uploads/kk', 'public');

            // 💾 Simpan data ke database
            Pendaftaran::create([
                'user_id' => auth()->id(),
                'paket_travel_id' => $request->paket_travel_id,
                'ktp' => $ktp,
                'kk' => $kk,
                'status' => 'pending',
                'catatan' => $request->catatan,
            ]);

            return redirect()->route('jamaah.dashboard')->with('success', 'Pendaftaran berhasil dikirim. Silakan menunggu verifikasi admin.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    // ❌ Hapus pendaftaran
    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();
        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus.');
    }
}
