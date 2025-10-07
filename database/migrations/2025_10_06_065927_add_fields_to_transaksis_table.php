<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
            $table->unsignedBigInteger('pendaftaran_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('booking_id')->nullable()->after('pendaftaran_id');
            $table->decimal('jumlah', 15, 2)->default(0)->after('booking_id');
            $table->string('status')->default('pending')->after('jumlah');

            // relasi opsional
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pendaftaran_id')->references('id')->on('pendaftarans')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['pendaftaran_id']);
            $table->dropForeign(['booking_id']);
            $table->dropColumn(['user_id', 'pendaftaran_id', 'booking_id', 'jumlah', 'status']);
        });
    }
};
