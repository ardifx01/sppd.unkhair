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
        Schema::table('app_surat_tugas_dinas', function (Blueprint $table) {
            $table->boolean('std_dk')->default(0)->comment('1 STD dalam kota')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_surat_tugas_dinas', function (Blueprint $table) {
            $table->dropColumn('std_dk');
        });
    }
};
