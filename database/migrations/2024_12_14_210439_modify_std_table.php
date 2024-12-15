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
        if (Schema::hasColumn($this->table, 'pimpinan_ttd')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign('app_surat_tugas_dinas_pimpinan_ttd_foreign');
                $table->dropColumn('pimpinan_ttd');
            });
        }

        if (!Schema::hasColumns($this->table, ['pimpinan_ttd'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->string('pimpinan_ttd')->nullable()->comment('pimpinan_ttd yg ttd')->after('status_std');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns($this->table, ['pimpinan_ttd'])) {
            Schema::dropColumns($this->table, ['pimpinan_ttd']);
        }
    }
};
