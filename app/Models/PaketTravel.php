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
        'gambar', //
    ];

    protected $casts = [
        'tanggal_berangkat' => 'datetime', // ✅ Cast ke Carbon
    ];

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
