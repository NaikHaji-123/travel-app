<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = ['user_id','paket_id','status'];

    public function paketTravel()
    {
        return $this->belongsTo(PaketTravel::class, 'paket_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
