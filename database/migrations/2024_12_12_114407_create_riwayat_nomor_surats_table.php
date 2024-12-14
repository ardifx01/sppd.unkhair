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
        Schema::create('app_riwayat_nomor_surat', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('nomor', false)->comment('nomor surat');
            $table->char('kode', 25)->comment('kode surat');
            $table->char('tahun', 4)->comment('tahun surat');
            $table->enum('jenis_surat', ['spd', 'st']);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_riwayat_nomor_surat');
    }
};
