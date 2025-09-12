<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendaftaran extends Model
{
    use HasFactory;

    // Kalau nama tabel di database "pendaftaran", tambahkan:
    // protected $table = 'pendaftaran';

    protected $fillable = [
        'user_id',
        'paket_travel_id',
        'status',
    ];

    /**
     * Relasi ke User
     * Satu pendaftaran dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Paket Travel
     * Satu pendaftaran hanya untuk satu paket
     */
    public function paketTravel()
    {
        return $this->belongsTo(PaketTravel::class, 'paket_travel_id');
    }

    /**
     * Relasi ke Verifikasi
     * Satu pendaftaran punya satu data verifikasi
     */
    public function verifikasi()
    {
        return $this->hasOne(Verifikasi::class, 'pendaftaran_id');
    }
}
