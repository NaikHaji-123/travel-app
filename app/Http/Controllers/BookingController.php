<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Simpan data booking ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'hp'      => 'required|string|max:20',
            'paket'   => 'required|string',
            'bukti'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'catatan' => 'nullable|string',
        ]);

        // Simpan file bukti transfer jika ada
        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('bukti-transfer', 'public');
        }

        $validated['user_id'] = auth()->id();

        Booking::create($validated);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Booking berhasil disimpan.');
    }
}
