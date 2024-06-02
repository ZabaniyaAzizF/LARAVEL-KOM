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
        //Permission Users (Untuk Admin)
        Permission::create(['name'=>'tambah-user']);
        Permission::create(['name'=>'edit-user']);
        Permission::create(['name'=>'hapus-user']);
        Permission::create(['name'=>'lihat-user']);

        //Permission Setting (Untuk Admin)
        Permission::create(['name'=>'edit-setting']);
        Permission::create(['name'=>'lihat-setting']);

        //Permission Spp Bulanan (Petugas dan Admin)
        Permission::create(['name'=>'lihat-bulanan']);

        //Pemission Pembayaran Spp (Untuk Petugas dan Admin)
        Permission::create(['name'=>'lihat-bayaran']);
        Permission::create(['name'=>'edit-bayaran']);

        //Permission History dan Tunggakan (Untuk Siswa)
        Permission::create(['name'=>'lihat-history']);
        Permission::create(['name'=>'lihat-tunggakan']);

        //Permission Kelas (Petugas dan Admin)
        Permission::create(['name'=>'tambah-kelas']);
        Permission::create(['name'=>'edit-kelas']);
        Permission::create(['name'=>'hapus-kelas']);
        Permission::create(['name'=>'lihat-kelas']);

        //Permission Ajaran (Petugas dan Admin)
        Permission::create(['name'=>'tambah-ajaran']);
        Permission::create(['name'=>'edit-ajaran']);
        Permission::create(['name'=>'hapus-ajaran']);
        Permission::create(['name'=>'lihat-ajaran']);

        //Untuk Membuat Role
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
        $roleAdmin->givePermissionTo('lihat-bulanan');
        $roleAdmin->givePermissionTo('lihat-bayaran');
        $roleAdmin->givePermissionTo('edit-bayaran');
        $roleAdmin->givePermissionTo('tambah-kelas');
        $roleAdmin->givePermissionTo('edit-kelas');
        $roleAdmin->givePermissionTo('hapus-kelas');
        $roleAdmin->givePermissionTo('lihat-kelas');
        $roleAdmin->givePermissionTo('tambah-ajaran');
        $roleAdmin->givePermissionTo('edit-ajaran');
        $roleAdmin->givePermissionTo('hapus-ajaran');
        $roleAdmin->givePermissionTo('lihat-ajaran');

        $roleManager = Role::findByName('petugas');
        $roleManager->givePermissionTo('lihat-bulanan');
        $roleManager->givePermissionTo('lihat-bayaran');
        $roleManager->givePermissionTo('edit-bayaran');
        $roleManager->givePermissionTo('tambah-kelas');
        $roleManager->givePermissionTo('edit-kelas');
        $roleManager->givePermissionTo('hapus-kelas');
        $roleManager->givePermissionTo('lihat-kelas');
        $roleManager->givePermissionTo('tambah-ajaran');
        $roleManager->givePermissionTo('edit-ajaran');
        $roleManager->givePermissionTo('hapus-ajaran');
        $roleManager->givePermissionTo('lihat-ajaran');

        $rolePegawai = Role::findByName('siswa');
        $rolePegawai->givePermissionTo('lihat-history');
        $rolePegawai->givePermissionTo('lihat-tunggakan');
    }
}
