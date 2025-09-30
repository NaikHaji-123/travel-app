<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class PaketTravel extends Model
{
    use HasFactory;

    protected $table = 'pakets'; // nama tabel
    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'harga',
        'tanggal_berangkat',
        'gambar',
    ];

    // Relasi: 1 paket bisa punya banyak pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    // Accessor untuk URL gambar
    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    // Mutator untuk upload gambar
    public function setGambarAttribute($file)
    {
        if ($file) {
            // hapus file lama jika ada
            if (isset($this->attributes['gambar']) && $this->attributes['gambar']) {
                Storage::disk('public')->delete($this->attributes['gambar']);
            }
            $this->attributes['gambar'] = $file->store('paket', 'public');
        }
    }
}
