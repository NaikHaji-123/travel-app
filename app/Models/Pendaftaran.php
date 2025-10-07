<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'user_id',
        'paket_id',
        'status',
    ];

    public function paketTravel()
    {
        return $this->belongsTo(PaketTravel::class, 'paket_id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'pendaftaran_id');
    }
    public function transaksi()
{
    return $this->hasMany(Transaksi::class, 'pendaftaran_id');
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
