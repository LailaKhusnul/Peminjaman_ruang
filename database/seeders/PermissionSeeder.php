<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles
        $roles = [
            'admin',
            'wadir',
            'dosen',
            'mahasiswa',
        ];

        // Define permissions
        $permissions = [
            'view_dashboard',
            'view_chart_on_dashboard',
            // Add more permissions as needed
        ];

        // Create roles
        foreach ($roles as $roleName) {
            Role::updateOrCreate(['name' => $roleName]);
        }

        // Create permissions
        foreach ($permissions as $permissionName) {
            Permission::updateOrCreate(['name' => $permissionName]);
        }

        // Assign permissions to roles
        Role::findByName('admin')->givePermissionTo(['view_dashboard', 'view_chart_on_dashboard']);
        Role::findByName('wadir')->givePermissionTo('view_chart_on_dashboard');
        // Assign other permissions to roles as needed

        // Assign roles to users
        $admin = User::find(1);
        if ($admin) {
            $admin->assignRole('admin');
        }

        $wadir = User::find(2); // Assuming user with ID 2 is wadir
        if ($wadir) {
            $wadir->assignRole('wadir');
        }

        // Assign roles to users based on role_type
        $usersDosen = User::where('role_type', 'dosen')->get();
        foreach ($usersDosen as $user) {
            $user->assignRole('dosen');
        }

        $usersMahasiswa = User::where('role_type', 'mahasiswa')->get();
        foreach ($usersMahasiswa as $user) {
            $user->assignRole('mahasiswa');
        }
        
        //
        // $role_admin = Role::updateOrCreate(
        //     [
        //         'name' => 'admin',
        //     ],
        //     ['name' => 'admin']
        // );

        // $role_wadir = Role::updateOrCreate(
        //     [
        //         'name' => 'wadir',
        //     ],
        //     ['name' => 'wadir']
        // );

        // $role_peminjam1 = Role::updateOrCreate(
        //     [
        //         'name' => 'peminjam1',
        //     ],
        //     ['name' => 'peminjam1']
        // );

        // $role_peminjam2 = Role::updateOrCreate(
        //     [
        //         'name' => 'peminjam2',
        //     ],
        //     ['name' => 'peminjam2']
        // );

        // $permission = Permission::updateOrCreate(
        //     [
        //         'name' => 'view_dashboard',
        //     ],
        //     ['name' => 'view_dashboard']
        // );

        // $permission2 = Permission::updateOrCreate(
        //     [
        //         'name' => 'view_chart_on_dashboard',
        //     ],
        //     ['name' => 'view_chart_on_dashboard']
        // );
        
        // $role_admin->givePermissionTo($permission);
        // $role_admin->givePermissionTo($permission2);
        // $role_wadir->givePermissionTo($permission2);

        // $user = User::find(1);
        // // $user2 = User::find(19);
        // // $user3 = User::find(20);

        // $user->assignRole(['admin', 'wadir']);
        // // $user2->assignRole('mahasiswa');
        // // $user3->assignRole('peminjam1');

    }
}
