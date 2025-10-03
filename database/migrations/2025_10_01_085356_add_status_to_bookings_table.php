<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('status')->default('pending');
            $table->string('ktp')->nullable();   // kolom untuk menyimpan path file KTP
            $table->string('kk')->nullable();    // kolom untuk menyimpan path file KK
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('ktp');
            $table->dropColumn('kk');
        });
    }
};
