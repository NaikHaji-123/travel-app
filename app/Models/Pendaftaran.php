<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'user_id',
        'paket_travel_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paketTravel()
    {
        return $this->belongsTo(PaketTravel::class);
    }

    public function verifikasi()
    {
        return $this->hasOne(Verifikasi::class);
    }
}
