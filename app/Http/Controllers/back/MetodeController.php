<?php

namespace App\Http\Controllers\back;

use App\Models\Metode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MetodeController extends Controller
{
    public function index(){
        $metode = Metode::get();
        
        return view('back.metode.index',[
            'metode' => $metode
        ]);
    }

    public function create(){
        $metode = Metode::get();

        return view('back.metode.create',[
            'metode' => $metode
        ]);
    }

    public function store(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'kode_metode'                   => 'required',
            'metode_pembayaran'             => 'required',
        ]);

        

        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

        $data['kode_metode']                    = $request->kode_metode;
        $data['metode_pembayaran']              = $request->metode_pembayaran;

        Metode::create($data);

        return redirect()->route('Metode')->with('success', 'Data successfully Created.');

    }

    public function edit(Request  $request, $id){
        $data = Metode::find($id);

        return view('back.metode.update',compact('data'));
    }

    public function update(Request $request, $id){
    
        // Find the instance of Kelas
        $data = Metode::find($id);
    
        // Validate the request
        $validator = Validator::make($request->all(),[
            'kode_metode'                   => 'required',
            'metode_pembayaran'             => 'required',
        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Update the attributes of the Kelas instance
        $data->kode_metode = $request->kode_metode;
        $data->metode_pembayaran = $request->metode_pembayaran;
    
        // Save the changes to the database
        $data->save();
    
        // Redirect to the desired route
        return redirect()->route('Metode')->with('success', 'Data successfully Updated.');
    }

    public function delete(Request $request, $id){
        // Find the instance of Kelas
        $data = Metode::find($id);
    
        // Jika data ditemukan, hapus
        if($data){
            $data->delete();
        }
    
        // Redirect ke route 'Data-kelas'
        return redirect()->route('Metode')->with('success', 'Data successfully Deleted.');
    }
    
}
