<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        return view('jamaah.halamanutama', compact('testimonis'));
    }
}
