<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah kolom password ke tabel jamaahs
     */
    public function up()
    {
        Schema::table('jamaahs', function (Blueprint $table) {
            // Kolom password dibuat nullable supaya SQLite tidak error
            $table->string('password')->nullable()->after('email');
        });

        // Opsional: isi default password untuk semua row lama
        DB::table('jamaahs')->update(['password' => 'default123']);
    }

    /**
     * Hapus kolom password jika rollback
     */
    public function down()
    {
        Schema::table('jamaahs', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
};
