<?php

namespace App\Http\Controllers\back;

use App\Models\Siswa;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    public function index(){
    // Misalnya, Anda mengambil data pengguna dari database
    $siswa = Siswa::all();
    
    // Kemudian, Anda lewatkan data pengguna ke tampilan
    return view('back.siswa.index', [
        'siswa' => $siswa
    ]);
    }

    public function create(){
        return view('back.siswa.create',[
            'kelas' => Kelas::get()
        ]);
    }

    public function store(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'nis'                  => 'required',
            'kelas_kode'           => 'required',
            'nama'                 => 'required',
            'telepon'              => 'required',
            'alamat'               => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['nis']              = $request->nis;
        $data['kelas_kode']       = $request->kelas_kode;
        $data['nama_siswa']       = $request->nama;
        $data['telepon']          = $request->telepon;
        $data['alamat']           = $request->alamat;

        Siswa::create($data);

        return redirect()->route('Data-siswa');

    }

    public function edit(Request  $request, $id){
        $data = Siswa::find($id);

        return view('back.siswa.update',[
            'kelas' => Kelas::get()
        ],compact('data'));
    }

    public function update(Request $request, $id){
    
        // Find the instance of Kelas
        $data = Siswa::find($id);
    
        // Validate the request
        $validator = Validator::make($request->all(),[
            'nis'                  => 'required',
            'kelas_kode'           => 'required',
            'nama'                 => 'required',
            'telepon'              => 'required',
            'alamat'               => 'required',
        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Update the attributes of the Kelas instance
        $data->nis                = $request->nis;
        $data->kelas_kode         = $request->kelas_kode;
        $data->nama_siswa         = $request->nama;
        $data->telepon            = $request->telepon;
        $data->alamat             = $request->alamat;
    
        // Save the changes to the database
        $data->save();
    
        // Redirect to the desired route
        return redirect()->route('Data-siswa');
    }

    public function delete(Request $request, $id){
        // Find the instance of Kelas
        $data = Siswa::find($id);
    
        // Jika data ditemukan, hapus
        if($data){
            $data->delete();
        }
    
        // Redirect ke route 'Data-kelas'
        return redirect()->route('Data-siswa');
    }

    

}
