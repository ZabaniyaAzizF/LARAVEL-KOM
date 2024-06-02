<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Tingkatan;
use Illuminate\Http\Request;

class TingkatController extends Controller
{
    public function index(){
        $tingkat = Tingkatan::get();
        
        return view('back.tingkatan.index',[
            'tingkatan' => $tingkat
        ]);
    }

    public function create(){
        return view('back.Tingkatan.create');
    }

    public function store(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'kode_tingkat'      => 'required',
            'tingkatan'           => 'required',
        ]);

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['kode_tingkat']       = $request->kode_tingkat;
        $data['tingkatan']            = $request->tingkatan;

        Tingkatan::create($data);

        return redirect()->route('Tingkatan');

    }

    public function edit(Request  $request, $id){
        $data = Tingkatan::find($id);

        return view('back.tingkatan.update',compact('data'));
    }

    public function update(Request $request, $id){
    
        // Find the instance of Kelas
        $data = Tingkatan::find($id);
    
        // Validate the request
        $validator = Validator::make($request->all(),[
            'kode_tingkat'          => 'required',
            'tingkatan'               => 'required',
        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Update the attributes of the Kelas instance
        $data->kode_tingkat = $request->kode_tingkat;
        $data->tingkatan = $request->tingkatan;
    
        // Save the changes to the database
        $data->save();
    
        // Redirect to the desired route
        return redirect()->route('Tingkatan');
    }

    public function delete(Request $request, $id){
        // Find the instance of Kelas
        $data = Tingkatan::find($id);
    
        // Jika data ditemukan, hapus
        if($data){
            $data->delete();
        }
    
        // Redirect ke route 'Data-kelas'
        return redirect()->route('Tingkatan');
    }

}
