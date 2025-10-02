<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'hp',
        'email',
        'paket',
        'ktp',
        'kk',
        'bukti',
        'catatan',
        'status',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke paket travel
    public function paketTravel()
    {
        return $this->belongsTo(PaketTravel::class, 'paket', 'nama_paket');
    }
}
