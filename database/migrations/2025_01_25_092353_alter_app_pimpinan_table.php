<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = "app_pimpinan";
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumns($this->table, ['user_id'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign('app_pimpinan_user_id_foreign');
                $table->dropColumn('user_id');
            });
        }

        if (!Schema::hasColumns($this->table, ['user_id'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->after('ppk')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumns($this->table, ['user_id'])) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropForeign('app_pimpinan_user_id_foreign');
                $table->dropColumn('user_id');
            });
        }
    }
};
