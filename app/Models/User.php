<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    // Kalau tabel kamu bernama "users", tidak perlu $table
    // Kalau misalnya nama tabel berbeda (misal "jamaah"), tambahkan:
    // protected $table = 'jamaah';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relasi: satu user bisa punya banyak pendaftaran
     */
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'user_id');
    }
}
