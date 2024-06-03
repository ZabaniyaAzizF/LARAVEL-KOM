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
        Permission::create(['name'=>'invoice-user']);
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
        Permission::create(['name'=>'invoice-kelas']);
        Permission::create(['name'=>'lihat-kelas']);

        //Permission Ajaran (Petugas dan Admin)
        Permission::create(['name'=>'tambah-ajaran']);
        Permission::create(['name'=>'edit-ajaran']);
        Permission::create(['name'=>'invoice-ajaran']);
        Permission::create(['name'=>'lihat-ajaran']);

        //Permission Tingkat (Petugas dan Admin)
        Permission::create(['name'=>'tambah-tingkat']);
        Permission::create(['name'=>'edit-tingkat']);
        Permission::create(['name'=>'invoice-tingkat']);
        Permission::create(['name'=>'lihat-tingkat']);

        //Untuk Membuat Role
        Role::create(['name'=>'admin']);
        Role::create(['name'=>'petugas']);
        Role::create(['name'=>'siswa']);


        $roleAdmin = Role::findByName('admin');
        $roleAdmin->givePermissionTo('tambah-user');
        $roleAdmin->givePermissionTo('edit-user');
        $roleAdmin->givePermissionTo('invoice-user');
        $roleAdmin->givePermissionTo('lihat-user');
        $roleAdmin->givePermissionTo('edit-setting');
        $roleAdmin->givePermissionTo('lihat-setting');
        $roleAdmin->givePermissionTo('lihat-bulanan');
        $roleAdmin->givePermissionTo('lihat-bayaran');
        $roleAdmin->givePermissionTo('edit-bayaran');
        $roleAdmin->givePermissionTo('tambah-kelas');
        $roleAdmin->givePermissionTo('edit-kelas');
        $roleAdmin->givePermissionTo('invoice-kelas');
        $roleAdmin->givePermissionTo('lihat-kelas');
        $roleAdmin->givePermissionTo('tambah-ajaran');
        $roleAdmin->givePermissionTo('edit-ajaran');
        $roleAdmin->givePermissionTo('invoice-ajaran');
        $roleAdmin->givePermissionTo('lihat-ajaran');
        $roleAdmin->givePermissionTo('tambah-tingkat');
        $roleAdmin->givePermissionTo('edit-tingkat');
        $roleAdmin->givePermissionTo('invoice-tingkat');
        $roleAdmin->givePermissionTo('lihat-tingkat');

        $roleManager = Role::findByName('petugas');
        $roleManager->givePermissionTo('lihat-bulanan');
        $roleManager->givePermissionTo('lihat-bayaran');
        $roleManager->givePermissionTo('edit-bayaran');
        $roleManager->givePermissionTo('tambah-kelas');
        $roleManager->givePermissionTo('edit-kelas');
        $roleManager->givePermissionTo('invoice-kelas');
        $roleManager->givePermissionTo('lihat-kelas');
        $roleManager->givePermissionTo('tambah-ajaran');
        $roleManager->givePermissionTo('edit-ajaran');
        $roleManager->givePermissionTo('invoice-ajaran');
        $roleManager->givePermissionTo('lihat-ajaran');
        $roleManager->givePermissionTo('tambah-tingkat');
        $roleManager->givePermissionTo('edit-tingkat');
        $roleManager->givePermissionTo('invoice-tingkat');
        $roleManager->givePermissionTo('lihat-tingkat');

        $rolePegawai = Role::findByName('siswa');
        $rolePegawai->givePermissionTo('lihat-history');
        $rolePegawai->givePermissionTo('lihat-tunggakan');
    }
}
