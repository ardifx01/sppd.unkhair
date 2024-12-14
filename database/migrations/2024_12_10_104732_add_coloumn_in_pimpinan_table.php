<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('app_pimpinan', function (Blueprint $table) {
            $table->boolean('ppk')->default(0)->after('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns('app_pimpinan', ['ppk'])) {
            Schema::table('app_pimpinan', function (Blueprint $table) {
                $table->dropColumn('ppk');
            });
        }
    }
};
