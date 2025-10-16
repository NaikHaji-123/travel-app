<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->string('ktp')->nullable()->after('paket_travel_id');
            $table->string('kk')->nullable()->after('ktp');
            $table->text('catatan')->nullable()->after('kk');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn(['ktp', 'kk', 'catatan']);
        });
    }
};
