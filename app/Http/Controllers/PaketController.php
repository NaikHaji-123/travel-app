<?php

namespace App\Http\Controllers;

use App\Models\PaketTravel;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = PaketTravel::latest()->get();
        return view('admin.paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'tanggal_berangkat' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar');
        }

        PaketTravel::create($data);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(PaketTravel $paket)
    {
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, PaketTravel $paket)
    {
        $data = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric',
            'tanggal_berangkat' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar');
        }

        $paket->update($data);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(PaketTravel $paket)
    {
        if ($paket->gambar) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($paket->gambar);
        }
        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus.');
    }
}
