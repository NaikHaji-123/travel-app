<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketTravel extends Model
{
    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'tanggal_berangkat',
    ];

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
