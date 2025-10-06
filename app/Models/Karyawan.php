<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; // Penting untuk otentikasi (login)

class Karyawan extends Authenticatable
{
    use HasFactory;

    // Nama tabel di database yang terkait dengan Model ini
    protected $table = 'karyawans';

    /**
     * Kolom yang diizinkan untuk diisi melalui mass assignment.
     */
    protected $fillable = [
        'nama',
        'jabatan',
        'email',
        'no_hp',
        'password',
    ];

    /**
     * Kolom yang harus disembunyikan saat Model diubah menjadi array atau JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * Kolom yang harus di-cast ke tipe data asli PHP (misalnya 'datetime').
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}