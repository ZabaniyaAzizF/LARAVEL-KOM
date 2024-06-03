<?php

namespace App\Http\Controllers\back;

use App\Models\Kelas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DataKelasController extends Controller
{
    public function index(){
        $kelas = Kelas::get();
        
        return view('back.kelas.index',[
            'kelas' => $kelas
        ]);
    }

    public function create(){
        return view('back.kelas.create');
    }

    public function store(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'kode_kelas'      => 'required',
            'kelas'           => 'required',
        ]);

        

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['kode_kelas']       = $request->kode_kelas;
        $data['kelas']            = $request->kelas;

        Kelas::create($data);

        return redirect()->route('Data-kelas');

    }

    public function edit(Request  $request, $id){
        $data = Kelas::find($id);

        return view('back.kelas.update',compact('data'));
    }

    public function update(Request $request, $id){
    
        // Find the instance of Kelas
        $data = Kelas::find($id);
    
        // Validate the request
        $validator = Validator::make($request->all(),[
            'kode_kelas'          => 'required',
            'kelas'               => 'required',
        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Update the attributes of the Kelas instance
        $data->kode_kelas = $request->kode_kelas;
        $data->kelas = $request->kelas;
    
        // Save the changes to the database
        $data->save();
    
        // Redirect to the desired route
        return redirect()->route('Data-kelas');
    }

    public function delete(Request $request, $id){
        // Find the instance of Kelas
        $data = Kelas::find($id);
    
        // Jika data ditemukan, hapus
        if($data){
            $data->delete();
        }
    
        // Redirect ke route 'Data-kelas'
        return redirect()->route('Data-kelas');
    }

    public function invoice(){
        $kelas = Kelas::get();
        
        return view('back.kelas.invoice',[
            'kelas' => $kelas
        ]);
    }

}
