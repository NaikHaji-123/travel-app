<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketTravel;

class PaketController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'tanggal_berangkat' => 'required|date',
        ]);

        PaketTravel::create($request->all());

        return back()->with('success', 'Paket berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'tanggal_berangkat' => 'required|date',
        ]);

        PaketTravel::findOrFail($id)->update($request->all());

        return back()->with('success', 'Paket berhasil diperbarui!');
    }

    public function destroy($id)
    {
        PaketTravel::findOrFail($id)->delete();
        return back()->with('success', 'Paket berhasil dihapus!');
    }
}
