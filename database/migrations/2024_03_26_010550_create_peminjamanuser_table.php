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
        Schema::create('peminjamanuser', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ruang')->nullable();        //Foreign key
            $table->string('tanggal_mulai');
            $table->string('tanggal_selesai');
            $table->string('kegiatan');
            $table->timestamps();

            $table->foreign('id_ruang')->references('id')->on('ruang')->onDelete('cascade'); // Tambahkan foreign key constraint
            //$table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            //$table->foreignId('id_ruang')->nullable()->constrained('ruang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamanuser');
    }
};
