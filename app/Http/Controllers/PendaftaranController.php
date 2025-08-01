<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Verifikasi;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    // 1. Jamaah: Menyimpan pendaftaran baru
    public function store(Request $request)
    {
        $request->validate([
            'paket_travel_id' => 'required|exists:paket_travels,id',
        ]);

        $pendaftaran = Pendaftaran::create([
            'user_id' => Auth::id(),
            'paket_travel_id' => $request->paket_travel_id,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Pendaftaran berhasil dikirim',
            'data' => $pendaftaran,
        ]);
    }

    // 2. Jamaah: Melihat status pendaftarannya
    public function indexUser()
    {
        $pendaftarans = Pendaftaran::with('paketTravel')
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($pendaftarans);
    }

    // 3. Admin: Melihat semua data pendaftaran
    public function index()
    {
        $pendaftarans = Pendaftaran::with(['user', 'paketTravel'])->get();
        return response()->json($pendaftarans);
    }

    // 4. Admin: Memverifikasi pendaftaran
    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        Verifikasi::create([
            'pendaftaran_id' => $id,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return response()->json([
            'message' => 'Pendaftaran berhasil diverifikasi',
            'data' => $pendaftaran
        ]);
    }
}
