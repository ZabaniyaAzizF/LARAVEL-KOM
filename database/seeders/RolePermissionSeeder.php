<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Permission Users
        Permission::create(['name'=>'tambah-user']);
        Permission::create(['name'=>'edit-user']);
        Permission::create(['name'=>'hapus-user']);
        Permission::create(['name'=>'lihat-user']);

        //Permission Setting
        Permission::create(['name'=>'edit-setting']);
        Permission::create(['name'=>'lihat-setting']);

        //Permission Kelas
        Permission::create(['name'=>'tambah-kelas']);
        Permission::create(['name'=>'edit-kelas']);
        Permission::create(['name'=>'hapus-kelas']);
        Permission::create(['name'=>'lihat-kelas']);

        //Permission Ajaran
        Permission::create(['name'=>'tambah-ajaran']);
        Permission::create(['name'=>'edit-ajaran']);
        Permission::create(['name'=>'hapus-ajaran']);
        Permission::create(['name'=>'lihat-ajaran']);


        Role::create(['name'=>'admin']);
        Role::create(['name'=>'petugas']);
        Role::create(['name'=>'siswa']);


        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('tambah-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('hapus-user');
        $roleAdmin->givePermissionTo('lihat-user');
        $roleAdmin->givePermissionTo('edit-setting');
        $roleAdmin->givePermissionTo('lihat-setting');

        $roleManager = Role::findByName('petugas');
        $roleManager->givePermissionTo('edit-user');
        $roleManager->givePermissionTo('lihat-user');
        $roleManager->givePermissionTo('edit-setting');
        $roleManager->givePermissionTo('lihat-setting');

        $rolePegawai = Role::findByName('siswa');
        $rolePegawai->givePermissionTo('edit-setting');
        $rolePegawai->givePermissionTo('lihat-setting');
    }
}
