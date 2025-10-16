<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PaketTravel;
use App\Models\Jamaah;
use App\Models\Pendaftaran;
use App\Models\Karyawan;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ========================
    // DASHBOARD ADMIN & DATA FETCHING
    // ========================
    public function index()
{
    $totalPaket = PaketTravel::count();
    $totalJamaah = User::where('role', 'jamaah')->count();
    $bookingPending = Pendaftaran::where('status', 'pending')->count();

    $pakets = PaketTravel::all();
    $jamaah = User::where('role', 'jamaah')->get();
    $pendaftaran = Pendaftaran::with(['user', 'paketTravel'])->get();
    $karyawan = Karyawan::all(); 
    $agents = Agent::all();
    $totalAgents = Agent::count();

    // Ambil transaksi terbaru
    $transaksis = \App\Models\Transaksi::with(['user', 'pendaftaran'])->latest()->get();

    return view('admin.dashboard', compact(
        'totalPaket',
        'totalJamaah',
        'bookingPending',
        'pakets',
        'jamaah',
        'pendaftaran',
        'karyawan',
        'agents',
        'totalAgents',
        'transaksis'
    ));
}


    public function destroyAgent($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();

        return redirect()->back()->with('success','Agent berhasil dihapus!');
    }

    // ===================================
    // CRUD PAKET
    // ===================================
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

    // ===================================
    // ACC / TOLAK PENDAFTARAN
    // ===================================
    public function accPendaftaran($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = 'acc';
        $pendaftaran->save();

        return redirect()->back()->with('success','Pendaftaran berhasil di-ACC!');
    }

    public function tolakPendaftaran($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = 'ditolak';
        $pendaftaran->save();

        return redirect()->back()->with('success','Pendaftaran ditolak.');
    }

    // ===================================
    // CRUD HAPUS JAMAAH
    // ===================================
    public function destroyJamaah($id)
{
    $jamaah = \App\Models\User::find($id);

    if (!$jamaah) {
        return redirect()->back()->with('error', 'Data jamaah tidak ditemukan.');
    }

    try {
        $jamaah->delete();
        return redirect()->back()->with('success', 'Data jamaah berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menghapus jamaah: ' . $e->getMessage());
    }
}

    // ===================================
    // UBAH PASSWORD ADMIN
    // ===================================
    public function ubahPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah!');
    }
}
