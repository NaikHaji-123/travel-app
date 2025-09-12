<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\PaketTravel;
use App\Models\User;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    // Tampilkan semua pendaftaran
    public function index()
    {
        $pendaftarans = Pendaftaran::with(['user', 'paketTravel', 'verifikasi'])->get();
        return view('pendaftaran.index', compact('pendaftarans'));
    }

    // Form tambah pendaftaran
    public function create()
    {
        $users = User::all();
        $paketTravels = PaketTravel::all();
        return view('pendaftaran.create', compact('users', 'paketTravels'));
    }

    // Simpan pendaftaran baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'paket_travel_id' => 'required',
            'status' => 'required',
        ]);

        Pendaftaran::create($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil ditambahkan.');
    }

    // Edit pendaftaran
    public function edit(Pendaftaran $pendaftaran)
    {
        $users = User::all();
        $paketTravels = PaketTravel::all();
        return view('pendaftaran.edit', compact('pendaftaran', 'users', 'paketTravels'));
    }

    // Update pendaftaran
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $pendaftaran->update($request->all());

        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil diperbarui.');
    }

    // Hapus pendaftaran
    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();
        return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus.');
    }
}
