<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'hp'   => 'required|string|max:20',
            'paket'=> 'required|string',
            'ktp'  => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kk'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'bukti'=> 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan file KTP, KK, dan Bukti Transfer
        $ktpPath = $request->file('ktp')->store('ktp', 'public');
        $kkPath = $request->file('kk')->store('kk', 'public');
        $buktiPath = $request->hasFile('bukti') ? $request->file('bukti')->store('bukti_transfer', 'public') : null;

        Booking::create([
             'user_id' => Auth::id(),   // ✅ tambahkan ini
            'nama'    => $request->nama,
            'hp'      => $request->hp,
            'paket'   => $request->paket,
            'ktp'     => $ktpPath,
            'kk'      => $kkPath,
            'bukti'   => $buktiPath,
            'catatan' => $request->catatan,
            'status'  => 'pending', // default
        ]);

        return redirect()->back()->with('success', 'Booking berhasil dikirim!');
    }
}
