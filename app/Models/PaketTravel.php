<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketTravel extends Model
{
    protected $table = 'paket_travels';

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'tanggal_berangkat',
        'gambar',
    ];

    // Karena migration pakai date, cukup 'date'
    protected $casts = [
    'tanggal_berangkat' => 'datetime',
];



    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'paket_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'paket_id');
    }
}
