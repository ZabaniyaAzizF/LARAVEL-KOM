<?php

namespace App\Http\Controllers\back;

use App\Models\DataSiswa;
use App\Models\User;
use App\Models\Kelas;
use App\Http\Controllers\Controller;
use App\Models\Ajaran;
use App\Models\Tingkatan;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    public function index(Request $request)
{
    // Prepare the query to get users with role 'siswa'
    $query = User::with(['ajaran', 'kelas'])->role('siswa');

    // Retrieve filter values from the request
    $kelasKode = $request->input('kelas_kode');

    // Add filter conditions to the query
    if ($kelasKode) {
        $query->where('kelas_kode', $kelasKode);
    }

    // Retrieve filtered students
    $siswa = $query->get();

    // Retrieve all classes, ajaran, and tingkatan
    $kelas = Kelas::all();
    $ajaran = Ajaran::all();
    $tingkatan = Tingkatan::all();

    // Return the view with the retrieved data
    return view('back.siswa.index', [
        'users' => $siswa,
        'ajaran' => $ajaran,
        'tingkatan' => $tingkatan,
        'kelas' => $kelas,
    ]);
}

public function view(Request $request, $kelasKode = null){
    // Prepare the query to get users with role 'siswa'
    $query = User::with(['ajaran', 'kelas'])->role('siswa');

    // Add filter conditions to the query based on $kelasKode
    if ($kelasKode) {
        $query->whereHas('kelas', function ($query) use ($kelasKode) {
            $query->where('kode_kelas', $kelasKode);
        });
    }

    // Retrieve filtered students
    $siswa = $query->get();

    // Retrieve all classes, ajaran, and tingkatan
    $kelas = Kelas::all();
    $ajaran = Ajaran::all();
    $tingkatan = Tingkatan::all();

    // Return the view with the retrieved data
    return view('back.siswa.views', [
        'users' => $siswa,
        'ajaran' => $ajaran,
        'tingkatan' => $tingkatan,
        'kelas' => $kelas,
    ]);
}


    // public function store(){
        
    // }

    // public function edit(){
        
    // }

    // public function update(){
        
    // }

    // public function delete(){
        
    // }

}
