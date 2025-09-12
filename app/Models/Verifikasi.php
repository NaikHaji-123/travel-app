<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Verifikasi extends Model
{
    use HasFactory;

    // Kalau nama tabel di database "verifikasi"
    // protected $table = 'verifikasi';

    protected $fillable = [
        'pendaftaran_id',
        'status',
        'catatan',
    ];

    /**
     * Relasi ke Pendaftaran
     * Satu verifikasi milik satu pendaftaran
     */
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id');
    }
}
