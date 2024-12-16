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
        if (Schema::hasColumn($this->table, 'spd_id')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign($this->table . '_spd_id_foreign');
                $table->dropColumn('spd_id');
            });
        }

        if (!Schema::hasColumns($this->table, ['spd_id'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->foreignUuid('spd_id')->nullable()->after('user_id')->constrained('app_surat_perjalanan_dinas', 'id')->onUpdate('cascade')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
};
