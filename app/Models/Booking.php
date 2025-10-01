<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'hp',
        'paket',
        'bukti',
        'catatan',
        'status', // pending / acc / ditolak
    ];

    public function jamaah()
    {
        return $this->belongsTo(Jamaah::class, 'nama', 'nama'); // contoh relasi sederhana
    }

    public function paketRelation()
    {
        return $this->belongsTo(PaketTravel::class, 'paket', 'nama_paket');
    }
}
