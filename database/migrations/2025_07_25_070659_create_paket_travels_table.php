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
            $table->id();
            $table->string('nama_paket');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->date('tanggal_berangkat');
            $table->string('gambar')->nullable(); // 👉 kolom untuk gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_travels');
    }
};
