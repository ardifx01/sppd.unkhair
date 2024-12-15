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
            $table->string('detail_jabatan')->nullable()->after('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns('app_pimpinan', ['detail_jabatan'])) {
            Schema::dropColumns('app_pimpinan', ['detail_jabatan']);
        }
    }
};
