<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $table = 'app_surat_perjalanan_dinas';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn($this->table, 'pejabat_ppk')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign('app_surat_perjalanan_dinas_pejabat_ppk_foreign');
                $table->dropColumn('pejabat_ppk');
            });
        }

        if (!Schema::hasColumns($this->table, ['pejabat_ppk', 'reviewer_id', 'alasan', 'tanggal_review'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->text('pejabat_ppk')->nullable()->comment('pejabat ppk yg ttd')->after('status_spd');
                $table->dateTime('tanggal_review')->nullable()->after('pejabat_ppk');
                $table->foreignId('reviewer_id')->nullable()->after('tanggal_review')->references('id')->on('users');
                $table->string('alasan')->nullable()->after('reviewer_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns($this->table, ['pejabat_ppk', 'reviewer_id', 'alasan', 'tanggal_review'])) {
            Schema::dropColumns($this->table, ['pejabat_ppk', 'reviewer_id', 'alasan', 'tanggal_review']);
        }
    }
};
