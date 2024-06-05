<?php

namespace App\Http\Controllers\back;

use App\Models\DataSiswa;
use App\Models\Kelas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    public function index(){
        $siswa = DataSiswa::get();
        $kelas = Kelas::all();
        
        return view('back.siswa.index',[
            'data_siswa' => $siswa,
            'kelas' => $kelas
        ]);
    }

    public function store(){
        
    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function delete(){
        
    }

}
