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
        Schema::create('app_surat_tugas_dinas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignUuid('spd_id')->nullable()->comment('surat tugas diterbitkan dr sppd')->references('id')->on('app_surat_perjalanan_dinas');
            $table->string('nomor_std')->nullable()->unique('nomor_std');
            $table->foreignUuid('pegawai_id')->nullable()->references('id')->on('app_pegawai');
            $table->foreignUuid('departemen_id')->nullable()->references('id')->on('app_departemen');
            $table->string('kegiatan_std')->nullable();
            $table->date('tanggal_mulai_tugas')->nullable();
            $table->date('tanggal_selesai_tugas')->nullable();
            $table->string('keterangan')->nullable();
            $table->foreignUuid('pimpinan_ttd')->nullable()->references('id')->on('app_pimpinan');
            $table->smallInteger('status_std', FALSE)->nullable()->default(0)->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_surat_tugas_dinas');
    }
};
