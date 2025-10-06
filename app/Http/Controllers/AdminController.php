<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PaketTravel;
use App\Models\Jamaah;
use App\Models\Booking;
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
        $pakets = PaketTravel::all();
        $jamaah = User::where('role', 'jamaah')->get();
        $bookings = Booking::all();
        $pendaftaran = Pendaftaran::with('user', 'paketTravel')->get();
        
        // Data untuk Karyawan dan Agent (sudah ditambahkan sebelumnya)
        $karyawan = Karyawan::all(); 
        $agents = Agent::all();
        $totalAgents = Agent::count();
        return view('admin.dashboard', compact(
            'totalPaket',
            'totalJamaah',
            'pakets',
            'jamaah',
            'bookings',
            'pendaftaran',
            'karyawan',
            'agents',
            'totalAgents',
        ));
    }

   

    // ===================================
    // CRUD KARYAWAN (sudah ada)
    // ===================================

    public function storeKaryawan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email', 
            'no_hp' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        Karyawan::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success','Karyawan berhasil ditambahkan!');
    }

    public function updateKaryawan(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email,'.$karyawan->id,
            'no_hp' => 'required|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = $request->only('nama', 'jabatan', 'email', 'no_hp');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $karyawan->update($data);

        return redirect()->back()->with('success','Data Karyawan berhasil diperbarui!');
    }

    public function destroyKaryawan($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()->back()->with('success','Karyawan berhasil dihapus!');
    }


    // ===================================
    // CRUD AGENT (sudah ada)
    // ===================================

    public function storeAgent(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode_agent' => 'required|string|max:50|unique:agents,kode_agent', 
            'email' => 'required|email|unique:agents,email',
            'no_hp' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        Agent::create([
            'nama' => $request->nama,
            'kode_agent' => $request->kode_agent,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success','Agent berhasil ditambahkan!');
    }

    public function updateAgent(Request $request, $id)
    {
        $agent = Agent::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kode_agent' => 'required|string|max:50|unique:agents,kode_agent,'.$agent->id,
            'email' => 'required|email|unique:agents,email,'.$agent->id,
            'no_hp' => 'required|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $data = $request->only('nama', 'kode_agent', 'email', 'no_hp');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $agent->update($data);

        return redirect()->back()->with('success','Data Agent berhasil diperbarui!');
    }

    public function destroyAgent($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->delete();

        return redirect()->back()->with('success','Agent berhasil dihapus!');
    }
    
    // ===================================
    // METODE CRUD LAMA (Paket, Jamaah, Booking, Password)
    // ===================================
    
    // CRUD PAKET
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

    // CRUD JAMAAH
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
            'password' => Hash::make($request->password),
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

    // BOOKING JAMAAH
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

    // UBAH PASSWORD ADMIN
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
