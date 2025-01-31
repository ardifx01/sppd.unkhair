<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = "app_surat_tugas_dinas";
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumns($this->table, ['reviewer_id', 'pimpinan_id'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign('app_surat_tugas_dinas_pimpinan_id_foreign');
                $table->dropForeign('app_surat_tugas_dinas_reviewer_id_foreign');
                $table->dropColumn('pimpinan_id');
                $table->dropColumn('reviewer_id');
            });
        }

        if (!Schema::hasColumns($this->table, ['pimpinan_id', 'tanggal_review', 'reviewer_id', 'alasan'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->foreignUuid('pimpinan_id')->nullable()->references('id')->on('app_pimpinan');
                $table->dateTime('tanggal_review')->nullable()->after('pimpinan_id');
                $table->foreignId('reviewer_id')->nullable()->after('tanggal_review')->references('id')->on('users');
                $table->string('alasan')->nullable()->after('reviewer_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns($this->table, ['pimpinan_id', 'tanggal_review', 'reviewer_id', 'alasan'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign('app_surat_tugas_dinas_pimpinan_id_foreign');
                $table->dropForeign('app_surat_tugas_dinas_reviewer_id_foreign');

                $table->dropColumn('pimpinan_id');
                $table->dropColumn('tanggal_review');
                $table->dropColumn('reviewer_id');
                $table->dropColumn('alasan');
            });
        }
    }
};
