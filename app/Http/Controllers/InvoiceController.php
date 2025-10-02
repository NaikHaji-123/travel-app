<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function create($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Jika ingin menambahkan data paket, bisa eager load
        $booking->load('paketTravel');

        return view('admin.invoice', compact('booking'));
    }
}
