<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function create($pendaftaranId)
    {
        // Ambil data pendaftaran dengan relasi user dan paketTravel
        $pendaftaran = Pendaftaran::with(['user', 'paketTravel'])->findOrFail($pendaftaranId);

        return view('admin.invoice', compact('pendaftaran'));
    }
}
