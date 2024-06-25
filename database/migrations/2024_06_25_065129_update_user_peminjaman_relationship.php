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
        Schema::table('peminjamanuser', function (Blueprint $table) {
            // Menambahkan kolom user_id dan foreign key jika belum ada
            if (!Schema::hasColumn('peminjamanuser', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();

                // Menambahkan foreign key constraint
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamanuser', function (Blueprint $table) {
            // Menghapus foreign key dan kolom user_id jika rollback
            if (Schema::hasColumn('peminjamanuser', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
