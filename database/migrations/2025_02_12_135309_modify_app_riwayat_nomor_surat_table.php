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
        Schema::table('app_riwayat_nomor_surat', function (Blueprint $table) {
            $table->enum('jenis_surat', ['st', 'std-dk', 'spd'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_riwayat_nomor_surat', function (Blueprint $table) {
            $table->enum('jenis_surat', ['spd', 'st'])->change();
        });
    }
};
