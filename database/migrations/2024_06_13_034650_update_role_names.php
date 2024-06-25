<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah nama role "peminjam1" menjadi "dosen"
        $peminjam1Role = Role::where('name', 'peminjam1')->first();
        if ($peminjam1Role) {
            $peminjam1Role->update(['name' => 'dosen']);
        }

        // Ubah nama role "peminjam2" menjadi "mahasiswa"
        $peminjam2Role = Role::where('name', 'peminjam2')->first();
        if ($peminjam2Role) {
            $peminjam2Role->update(['name' => 'mahasiswa']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Kembalikan nama role menjadi "peminjam1" dan "peminjam2"
        $dosenRole = Role::where('name', 'dosen')->first();
        if ($dosenRole) {
            $dosenRole->update(['name' => 'peminjam1']);
        }

        $mahasiswaRole = Role::where('name', 'mahasiswa')->first();
        if ($mahasiswaRole) {
            $mahasiswaRole->update(['name' => 'peminjam2']);
        }
    }
};
