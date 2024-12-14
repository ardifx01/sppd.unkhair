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
        Schema::create('app_pegawai', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nik', 20)->nullable()->unique('nik_pegawai');
            $table->string('nip', 20)->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->enum('jk', ['L', 'P'])->nullable();
            $table->string('tempat_lahir', 50)->nullable();
            $table->string('tanggal_lahir', 25)->nullable();
            $table->string('agama', 25)->nullable();
            $table->string('golongan')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('jabatan_tugas_tambahan')->nullable();
            $table->uuid('unit_kerja_id')->nullable()->comment('join departemen');
            $table->string('unit_kerja_string')->nullable();
            $table->uuid('departemen_id')->nullable()->comment('join departemen');
            $table->string('departemen_string')->nullable();
            $table->string('hp', 20)->nullable();
            $table->string('email', 50)->nullable()->unique('email_pegawai');
            $table->string('alamat')->nullable();
            $table->string('kategori_pegawai')->nullable()->comment('tendik asn, tendik kontrak, dosen asn dan dosen kontrak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_pegawai');
    }
};
