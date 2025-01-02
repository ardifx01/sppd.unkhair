<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $table = "app_kode_surat";
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn($this->table, 'urutan')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('urutan');
            });
        }

        if (!Schema::hasColumns($this->table, ['urutan'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->float('urutan')->nullable()->after('keterangan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
