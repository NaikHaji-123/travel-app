<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketTravel extends Model
{
    protected $table = 'paket_travels'; // ✅ tambahkan ini
    
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
