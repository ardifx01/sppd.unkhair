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
        Schema::table('app_surat_perjalanan_dinas', function (Blueprint $table) {
            $table->text('kegiatan_spd')->nullable()->change();
        });

        Schema::table('app_surat_tugas_dinas', function (Blueprint $table) {
            $table->text('kegiatan_std')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_surat_perjalanan_dinas', function (Blueprint $table) {
            $table->string('kegiatan_spd')->nullable()->change();
        });

        Schema::table('app_surat_tugas_dinas', function (Blueprint $table) {
            $table->string('kegiatan_std')->nullable()->change();
        });
    }
};
