<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $table = 'app_riwayat_nomor_surat';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table($this->table, function (Blueprint $table) {
            $table->smallInteger('nomor', false)->comment('nomor surat')->change();
        });

        if (!Schema::hasColumns($this->table, ['surat_id'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->char('surat_id', 36)->nullable()->comment('sppd_id / std_id')->after('keterangan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table($this->table, function (Blueprint $table) {
            $table->char('nomor', 10)->nullable()->change();
        });

        if (Schema::hasColumns($this->table, ['surat_id'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('surat_id');
            });
        }
    }
};
