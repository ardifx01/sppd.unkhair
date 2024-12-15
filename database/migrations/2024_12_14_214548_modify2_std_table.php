<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $table = 'app_surat_tugas_dinas';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn($this->table, 'pegawai_id')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign('app_surat_tugas_dinas_pegawai_id_foreign');
                $table->dropColumn('pegawai_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn($this->table, 'pegawai_id')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign('app_surat_tugas_dinas_pegawai_id_foreign');
                $table->dropColumn('pegawai_id');
            });
        }
    }
};
