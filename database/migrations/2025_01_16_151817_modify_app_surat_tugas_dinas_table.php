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
        if (Schema::hasColumns($this->table, ['tanggal_std'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('tanggal_std');
            });
        }

        if (!Schema::hasColumns($this->table, ['tanggal_std'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->date('tanggal_std')->nullable()->after('nomor_std');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns($this->table, ['tanggal_std'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('tanggal_std');
            });
        }
    }
};
