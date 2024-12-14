<?php

use App\Models\User;
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
        Schema::create('app_surat_perjalanan_dinas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('nomor_spd')->nullable()->unique('nomor_spd');
            $table->foreignUuid('pegawai_id')->nullable()->references('id')->on('app_pegawai');
            $table->foreignUuid('departemen_id')->nullable()->references('id')->on('app_departemen');
            $table->string('kegiatan_spd')->nullable();
            $table->string('angkutan')->nullable();
            $table->string('berangakat', 100)->nullable();
            $table->string('tujuan', 100)->nullable();
            $table->char('lama_pd', 3)->nullable();
            $table->date('tanggal_berangakat')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->string('keterangan')->nullable();
            $table->foreignUuid('pejabat_ppk')->nullable()->references('id')->on('app_pimpinan');
            $table->smallInteger('status_spd', FALSE)->nullable()->default(0)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_surat_perjalanan_dinas');
    }
};
