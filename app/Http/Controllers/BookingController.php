<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'paket_travel_id' => 'required|exists:paket_travels,id',
            'hp' => 'required|string|max:20',
            'ktp' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kk' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'bukti' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'catatan' => 'nullable|string|max:500',
        ]);

        // Simpan file
        $ktpPath = $request->file('ktp')->store('uploads/ktp', 'public');
        $kkPath  = $request->file('kk')->store('uploads/kk', 'public');
        $buktiPath = $request->file('bukti')->store('uploads/bukti', 'public');

        // Simpan data booking
        Booking::create([
            'user_id' => Auth::id(),
            'nama' => Auth::user()->nama,
            'hp' => $request->hp,
            'paket_travel_id' => $request->paket_travel_id,
            'paket' => $request->paket ?? '', // optional, kalau kolom masih ada
            'ktp' => $ktpPath,
            'kk' => $kkPath,
            'bukti' => $buktiPath,
            'catatan' => $request->catatan,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Booking berhasil dikirim! Silakan tunggu verifikasi admin.');
    }
}
