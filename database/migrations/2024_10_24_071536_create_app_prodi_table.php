<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('app_prodi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('fakultas_id')->nullable()->references('id')->on('app_fakultas');
            $table->string('kode_prodi', 10)->comment('kode program studi');
            $table->string('nama_prodi', 150)->comment('nama program studi');
            $table->char('status', 1)->comment('status program studi');
            $table->string('jenjang_prodi', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_prodi');
    }
};
