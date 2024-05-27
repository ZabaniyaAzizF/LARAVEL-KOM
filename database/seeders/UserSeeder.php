<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('123456'),
        ]);
        $admin->assignRole('admin');

        $petugas = User::create([
            'name'      => 'petugas',
            'email'     => 'petugas@gmail.com',
            'password'  => Hash::make('123456'),
        ]);
        $petugas->assignRole('petugas');

        $siswa = User::create([
            'name'      => 'siswa',
            'email'     => 'siswa@gmail.com',
            'password'  => Hash::make('123456'),
            'nis'       => '1234567898',
        ]);
        $siswa->assignRole('siswa');
    }
}
