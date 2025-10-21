<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pendaftaran_id',
        'booking_id',
        'jumlah',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function paketTravel()
{
    return $this->hasOneThrough(
        \App\Models\PaketTravel::class,
        \App\Models\Pendaftaran::class,
        'id', // Foreign key di tabel pendaftarans
        'id', // Foreign key di tabel paket_travels
        'pendaftaran_id', // Foreign key di tabel transaksis
        'paket_travel_id' // Foreign key di tabel pendaftarans
    );
}


    
}
