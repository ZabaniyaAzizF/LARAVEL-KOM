<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataPetugasController extends Controller
{
    public function index(){
        $petugas = Petugas::get();
        
        return view('back.petugas.index',[
            'petugas' => $petugas
        ]);
    }

    public function create(){
        return view('back.petugas.create');
    }

    public function store(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'kode_petugas'      => 'required',
            'petugas'           => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['kode_petugas']     = $request->kode_petugas;
        $data['nama_petugas']     = $request->petugas;

        Petugas::create($data);

        return redirect()->route('Data-petugas');

    }

    public function edit(Request  $request, $id){
        $data = Petugas::find($id);

        return view('back.petugas.update',compact('data'));
    }

    public function update(Request $request, $id){
    
        // Find the instance of Kelas
        $data = Petugas::find($id);
    
        // Validate the request
        $validator = Validator::make($request->all(),[
            'kode_petugas'      => 'required',
            'petugas'           => 'required',
        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Update the attributes of the Kelas instance
        $data->kode_petugas = $request->kode_petugas;
        $data->nama_petugas = $request->petugas;
    
        // Save the changes to the database
        $data->save();
    
        // Redirect to the desired route
        return redirect()->route('Data-petugas');
    }

    public function delete(Request $request, $id){
        // Find the instance of Kelas
        $data = Petugas::find($id);
    
        // Jika data ditemukan, hapus
        if($data){
            $data->delete();
        }
    
        // Redirect ke route 'Data-kelas'
        return redirect()->route('Data-petugas');
    }

}
