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
        if (Schema::hasTable('app_pimpinan')) {
            Schema::dropIfExists('app_pimpinan');
        }

        Schema::create('app_pimpinan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_pimpinan')->nullable();
            $table->string('nip')->nullable();
            $table->string('golongan')->nullable();
            $table->string('jabatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_pimpinan');
    }
};
