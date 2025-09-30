<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'jamaah_id',
        'paket_id',
        'status', // pending, confirmed, cancelled
    ];

    // Relasi ke Jamaah
    public function jamaah()
    {
        return $this->belongsTo(Jamaah::class);
    }

    // Relasi ke Paket
    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
