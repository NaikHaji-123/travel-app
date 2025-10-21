<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimoniSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('testimonis')->insert([
            [
                'nama' => 'Ibu Ningsih',
                'kota' => 'Tangerang',
                'pesan' => 'Alhamdulillah, pelayanan selama Umrah sangat memuaskan. Terima kasih Syakirasya!',
                'foto' => 'https://cdn-icons-png.flaticon.com/512/4140/4140048.png',
            ],
            [
                'nama' => 'Pak Ujang',
                'kota' => 'Tangerang',
                'pesan' => 'Tim pembimbing sangat sabar dan berpengalaman. Perjalanan ibadah kami jadi lancar.',
                'foto' => 'https://cdn-icons-png.flaticon.com/512/2202/2202112.png',
            ],
            [
                'nama' => 'Pak Deripin',
                'kota' => 'Tangerang',
                'pesan' => 'Hotel nyaman, makanan enak, dan jadwal tertib. Saya akan rekomendasikan ke keluarga.',
                'foto' => 'https://cdn-icons-png.flaticon.com/512/1999/1999625.png',
            ],
            [
                'nama' => 'Ibu Rahma',
                'kota' => 'Bekasi',
                'pesan' => 'Pelayanan cepat dan ramah. Semua jadwal sesuai, Alhamdulillah perjalanan Umrah lancar.',
                'foto' => 'https://cdn-icons-png.flaticon.com/512/4140/4140037.png',
            ],
             [
                'nama' => 'Mukhlis',
                'kota' => 'Tangerang',
                'pesan' => 'Pelayanan ramah dan nyaman, pembimbing nya juga bagus, Top Lah rekomen banget ini.',
                'foto' => 'foto_testimoni/BALIK.jpg',
            ],
            [
                'nama' => 'Baraa',
                'kota' => 'Tangerang',
                'pesan' => 'Joss Gandoss, Mantep Poko e.',
                'foto' => 'https://cdn-icons-png.flaticon.com/512/1999/1999625.png',
            ],
        ]);
    }
}
