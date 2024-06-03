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
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'kode_ajaran' => 'required',
            'tahun_ajaran' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Ubah status data yang aktif sebelumnya menjadi tidak aktif
        Ajaran::where('status', 'aktif')->update(['status' => 'tidak aktif']);
    
        // Buat data baru dengan status aktif
        $data['kode_ajaran'] = $request->kode_ajaran;
        $data['tahun_ajaran'] = $request->tahun_ajaran;
    
        Ajaran::create($data);
    
        // Redirect ke route Ajaran
        return redirect()->route('Ajaran');
    }
    

    public function edit(Request  $request, $id){
        $data = Ajaran::find($id);

        return view('back.ajaran.update',compact('data'));
    }


    public function update(Request $request, $id) {
        // Temukan instance dari Ajaran
        $data = Ajaran::find($id);
    
        // Validasi permintaan
        $validator = Validator::make($request->all(), [
            'kode_ajaran' => 'required',
            'tahun_ajaran' => 'required',
        ]);
    
        // Jika validasi gagal, redirect kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Ubah status data yang aktif sebelumnya menjadi tidak aktif
        Ajaran::where('status', 'aktif')->update(['status' => 'tidak aktif']);
    
        // Perbarui atribut dari instance Ajaran
        $data->kode_ajaran  = $request->kode_ajaran;
        $data->tahun_ajaran = $request->tahun_ajaran;
        $data->status = 'aktif';
    
        // Simpan perubahan ke database
        $data->save();
    
        // Redirect ke route yang diinginkan
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

    public function invoice(){
        $ajaran = Ajaran::get();
        
        return view('back.ajaran.invoice',[
            'ajaran' => $ajaran
        ]);
    }

}
