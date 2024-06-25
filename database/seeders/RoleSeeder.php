<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        

        // Menghapus role peminjam2 jika ada
        // $roleToDelete = Role::where('name', 'writer')->first();
        // if ($roleToDelete) {
        //     $roleToDelete->delete();
        // }
    }
}
