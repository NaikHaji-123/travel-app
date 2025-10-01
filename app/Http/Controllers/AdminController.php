<?php

namespace App\Http\Controllers;

use App\Models\PaketTravel;
use App\Models\Jamaah;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ========================
    // DASHBOARD ADMIN
    // ========================
    public function index()
    {
        $totalPaket = PaketTravel::count();
        $totalJamaah = Jamaah::count();
        $pakets = PaketTravel::all();
        $jamaah = Jamaah::all();
        $bookings = Booking::all();

        return view('admin.dashboard', compact(
            'totalPaket',
            'totalJamaah',
            'pakets',
            'jamaah',
            'bookings'
        ));
    }

    // ========================
    // CRUD PAKET
    // ========================
    public function storePaket(Request $request)
    {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'tanggal_berangkat' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('nama_paket', 'deskripsi', 'harga', 'tanggal_berangkat');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('paket','public');
        }

        PaketTravel::create($data);

        return redirect()->back()->with('success','Paket berhasil ditambahkan!');
    }

    public function updatePaket(Request $request, $id)
    {
        $paket = PaketTravel::findOrFail($id);

        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric',
            'tanggal_berangkat' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('nama_paket', 'deskripsi', 'harga', 'tanggal_berangkat');

        if ($request->hasFile('gambar')) {
            if ($paket->gambar && Storage::disk('public')->exists($paket->gambar)) {
                Storage::disk('public')->delete($paket->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('paket','public');
        }

        $paket->update($data);

        return redirect()->back()->with('success','Paket berhasil diperbarui!');
    }

    public function destroyPaket($id)
    {
        $paket = PaketTravel::findOrFail($id);

        if ($paket->gambar && Storage::disk('public')->exists($paket->gambar)) {
            Storage::disk('public')->delete($paket->gambar);
        }

        $paket->delete();

        return redirect()->back()->with('success','Paket berhasil dihapus!');
    }

    // ========================
    // CRUD JAMAAH
    // ========================
    public function storeJamaah(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:jamaahs,email',
            'no_hp' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        Jamaah::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success','Jamaah berhasil ditambahkan!');
    }

    public function updateJamaah(Request $request, $id)
    {
        $jamaah = Jamaah::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:jamaahs,email,'.$jamaah->id,
            'no_hp' => 'required|string|max:20',
        ]);

        $jamaah->update($request->only('nama','email','no_hp'));

        return redirect()->back()->with('success','Jamaah berhasil diperbarui!');
    }

    public function destroyJamaah($id)
    {
        $jamaah = Jamaah::findOrFail($id);
        $jamaah->delete();

        return redirect()->back()->with('success','Jamaah berhasil dihapus!');
    }

    // ========================
    // BOOKING JAMAAH
    // ========================
    public function bookingAcc($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'acc';
        $booking->save();

        return redirect()->back()->with('success','Booking berhasil di-ACC!');
    }

    public function bookingTolak($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'ditolak';
        $booking->save();

        return redirect()->back()->with('success','Booking ditolak.');
    }
}
