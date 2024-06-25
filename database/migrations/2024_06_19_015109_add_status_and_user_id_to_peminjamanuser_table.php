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
            // Menambahkan kolom user_id dan status
            $table->unsignedBigInteger('user_id');        // Foreign key for user
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status field

            // Tambahkan foreign key constraint untuk user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint for user
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamanuser', function (Blueprint $table) {
            // Drop foreign key dan kolom saat rollback
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->dropColumn('status');
        });
    }
};
