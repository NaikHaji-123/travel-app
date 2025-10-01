<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class JamaahController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => 'jamaah',
        ]);

        return back()->with('success', 'Jamaah berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $jamaah = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $jamaah->id,
            'no_hp' => 'required|string|max:20',
        ]);

        $jamaah->update($request->only('nama','email','no_hp'));

        return back()->with('success', 'Jamaah berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Jamaah berhasil dihapus!');
    }
}
