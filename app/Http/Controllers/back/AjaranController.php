<?php

namespace App\Http\Controllers\back;

use App\Models\Ajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AjaranController extends Controller
{
    public function index(){
        $ajaran = Ajaran::get();
        
        return view('back.ajaran.index',[
            'ajaran' => $ajaran
        ]);
    }

    public function create(){
        return view('back.ajaran.create');
    }

    public function store(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'kode_ajaran'           => 'required',
            'tahun_ajaran'          => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['kode_ajaran']       = $request->kode_ajaran;
        $data['tahun_ajaran']      = $request->tahun_ajaran;

        Ajaran::create($data);

        return redirect()->route('Ajaran');

    }

    public function edit(Request  $request, $id){
        $data = Ajaran::find($id);

        return view('back.ajaran.update',compact('data'));
    }


    public function update(Request $request, $id){
    
        // Find the instance of Kelas
        $data = Ajaran::find($id);
    
        // Validate the request
        $validator = Validator::make($request->all(),[
            'kode_ajaran'          => 'required',
            'tahun_ajaran'         => 'required',
        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Update the attributes of the Kelas instance
        $data->kode_ajaran  = $request->kode_ajaran;
        $data->tahun_ajaran = $request->tahun_ajaran;
    
        // Save the changes to the database
        $data->save();
    
        // Redirect to the desired route
        return redirect()->route('Ajaran');
    }

    public function delete(Request $request, $id){
        // Find the instance of Kelas
        $data = Ajaran::find($id);
    
        // Jika data ditemukan, hapus
        if($data){
            $data->delete();
        }
    
        // Redirect ke route 'Data-kelas'
        return redirect()->route('Ajaran');
    }

}
