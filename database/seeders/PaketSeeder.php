<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaketTravel; // pastikan modelnya sesuai

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaketTravel::create([
            'nama_paket' => 'Umrah Akhir Tahun 2025',
            'deskripsi' => 'Paket spesial akhir tahun 12 hari',
            'harga' => 29000000,
            'tanggal_berangkat' => '2025-12-20',
        ]);

        PaketTravel::create([
            'nama_paket' => 'Umrah Ramadhan 2026',
            'deskripsi' => 'Nikmati ibadah Umrah di bulan Ramadhan',
            'harga' => 35000000,
            'tanggal_berangkat' => '2026-03-10',
        ]);
    }
}
