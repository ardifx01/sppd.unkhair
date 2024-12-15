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
        if (Schema::hasTable('app_surat_tugas_dinas_has_pegawai')) {
            Schema::dropIfExists('app_surat_tugas_dinas_has_pegawai');
        }

        Schema::create('app_surat_tugas_dinas_has_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('stugas_id')->nullable()->constrained('app_surat_tugas_dinas')->onDelete('cascade');
            $table->foreignUuid('pegawai_id')->nullable()->references('id')->on('app_pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_surat_tugas_dinas_has_pegawai');
    }
};
