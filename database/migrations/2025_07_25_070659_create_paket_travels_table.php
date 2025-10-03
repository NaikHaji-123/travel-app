<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paket_travels', function (Blueprint $table) {
            $table->id(); // Primary Key (auto increment)
            $table->string('nama_paket'); // Nama paket travel
            $table->text('deskripsi')->nullable(); // Deskripsi paket (nullable biar fleksibel)
            $table->decimal('harga', 15, 2); // Harga (15 digit, 2 angka desimal)
            $table->date('tanggal_berangkat')->nullable(); // Tanggal keberangkatan (nullable biar aman)
            $table->string('gambar')->nullable(); // Tambahan: untuk menyimpan foto/gambar paket
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_travels');
    }
};
