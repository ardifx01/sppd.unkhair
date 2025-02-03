<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = "app_surat_tugas_dinas_has_pegawai";

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table($this->table, function (Blueprint $table) {
            $table->renameColumn('stugas_id', 'surat_tugas_dinas_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table($this->table, function (Blueprint $table) {
            $table->renameColumn('surat_tugas_dinas_id', 'stugas_id');
        });
    }
};
