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
        if (!Schema::hasColumns($this->table, ['kelengkapan_laporan_std', 'tembusan_std'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->json('kelengkapan_laporan_std')->nullable()->after('keterangan');
                $table->json('tembusan_std')->nullable()->after('kelengkapan_laporan_std');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns($this->table, ['kelengkapan_laporan_std', 'tembusan_std'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('kelengkapan_laporan_std');
                $table->dropColumn('tembusan_std');
            });
        }
    }
};
