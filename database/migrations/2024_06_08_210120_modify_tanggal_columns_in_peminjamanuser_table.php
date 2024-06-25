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
            //Mengubah tipe data kolom tanggal_mulai dari string ke date
            $table->date('tanggal_mulai')->change();
            // Mengubah tipe data kolom tanggal_selesai dari string ke date
            $table->date('tanggal_selesai')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamanuser', function (Blueprint $table) {
            //Mengubah tipe data kolom tanggal_mulai kembali ke string
            $table->string('tanggal_mulai')->change();
            // Mengubah tipe data kolom tanggal_selesai kembali ke string
            $table->string('tanggal_selesai')->change();
        });
    }
};
