<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $table = 'app_pegawai';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn($this->table, 'pangkat')) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropColumn('pangkat');
            });
        }

        if (!Schema::hasColumns($this->table, ['pangkat'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->string('pangkat', 100)->nullable()->after('agama');
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
