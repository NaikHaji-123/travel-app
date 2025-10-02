<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'hp'   => 'required|string|max:20',
            'paket'=> 'required|string',
            'bukti'=> 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('bukti')) {
            $filePath = $request->file('bukti')->store('bukti_transfer', 'public');
        }

        Booking::create([
            'nama'    => $request->nama,
            'hp'      => $request->hp,
            'paket'   => $request->paket,
            'bukti'   => $filePath,
            'catatan' => $request->catatan,
            'status'  => 'pending', // ✅ default
        ]);

        return redirect()->back()->with('success', 'Booking berhasil dikirim!');
    }
}
