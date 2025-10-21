<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PaketTravel;
use App\Models\Pendaftaran;
use App\Models\Karyawan;
use App\Models\Agent;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ========================
    // DASHBOARD ADMIN
    // ========================
    public function index()
    {
        $totalPaket = PaketTravel::count();
        $totalJamaah = User::where('role', 'jamaah')->count();
        $bookingPending = Pendaftaran::where('status', 'pending')->count();
        $totalAgents = Agent::count();

        $pakets = PaketTravel::all();
        $jamaah = User::where('role', 'jamaah')->get();
        $pendaftaran = Pendaftaran::with(['user', 'paketTravel'])->get();
        $karyawan = Karyawan::all(); 
        $agents = Agent::all();
        $transaksis = Transaksi::with(['user', 'pendaftaran.paketTravel'])->latest()->get();
        $totalPembayaran = Transaksi::where('status', 'acc')->sum('jumlah');

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
            'transaksis',
            'totalPembayaran'
        ));
    }

    // ========================
    // CRUD AGENT
    // ========================
    public function storeAgent(Request $request)
    {
        $validated = $request->validate([
            'nama_agent' => 'required|string|max:255',
            'kode_agent' => 'required|string|max:10|unique:agents,kode_agent',
            'email' => 'required|email|unique:agents,email',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string|min:6',
        ]);

        Agent::create([
            'nama_agent' => $validated['nama_agent'],
            'kode_agent' => $validated['kode_agent'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->back()->with('success', 'Agent berhasil ditambahkan!');
    }

    public function destroyAgent($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();
        return redirect()->back()->with('success', 'Agent berhasil dihapus!');
    }

public function storeKaryawan(Request $request)
{
    // validasi data
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:karyawans,email',
        'no_hp' => 'required|string|max:20',
        'jabatan' => 'required|string|max:100',
        'password' => 'required|string|min:6',
    ]);

    // simpan ke database
    \App\Models\Karyawan::create([
        'nama' => $validated['nama'],
        'email' => $validated['email'],
        'no_hp' => $validated['no_hp'],
        'jabatan' => $validated['jabatan'],
        'password' => bcrypt($validated['password']),
    ]);

    return redirect()->back()->with('success', 'Data karyawan berhasil ditambahkan.');
}

// Update Karyawan
public function updateKaryawan(Request $request, $id)
{
    $karyawan = \App\Models\Karyawan::findOrFail($id);

    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'jabatan' => 'nullable|string|max:100',
        'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
        'no_hp' => 'nullable|string|max:20',
        'password' => 'nullable|string|min:6',
    ]);

    // Jika ada password baru, enkripsi; kalau tidak, jangan ubah kolom password
    if (!empty($validated['password'])) {
        $validated['password'] = bcrypt($validated['password']);
    } else {
        unset($validated['password']);
    }

    // Update record
    $karyawan->update($validated);

    return redirect()->back()->with('success', 'Data karyawan berhasil diperbarui.');
}

// Hapus Karyawan
public function destroyKaryawan($id)
{
    $karyawan = \App\Models\Karyawan::findOrFail($id);
    $karyawan->delete();

    return redirect()->back()->with('success', 'Data karyawan berhasil dihapus.');
}




    // ========================
    // CRUD PAKET TRAVEL
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
            $data['gambar'] = $request->file('gambar')->store('paket', 'public');
        }

        PaketTravel::create($data);
        return redirect()->back()->with('success', 'Paket berhasil ditambahkan!');
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
            $data['gambar'] = $request->file('gambar')->store('paket', 'public');
        }

        $paket->update($data);
        return redirect()->back()->with('success', 'Paket berhasil diperbarui!');
    }

    public function destroyPaket($id)
    {
        $paket = PaketTravel::findOrFail($id);

        if ($paket->gambar && Storage::disk('public')->exists($paket->gambar)) {
            Storage::disk('public')->delete($paket->gambar);
        }

        $paket->delete();
        return redirect()->back()->with('success', 'Paket berhasil dihapus!');
    }

    // ========================
    // PENDAFTARAN
    // ========================
    public function accPendaftaran($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = 'acc';
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Pendaftaran berhasil di-ACC!');
    }

    public function tolakPendaftaran($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->status = 'ditolak';
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Pendaftaran ditolak.');
    }

    // ========================
    // HAPUS JAMAAH
    // ========================
    public function destroyJamaah($id)
    {
        $jamaah = User::find($id);
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

    // ========================
    // UBAH PASSWORD ADMIN
    // ========================
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
