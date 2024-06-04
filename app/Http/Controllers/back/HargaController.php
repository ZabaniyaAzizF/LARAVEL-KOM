<?php

namespace App\Http\Controllers\back;

use App\Models\HargaSpp;
use App\Models\Ajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function index(){
        $harga = HargaSpp::get();
        $academicYears = Ajaran::all();
        
        return view('back.harga.index', [
            'harga_spp' => $harga,
            'ajaran' => $academicYears
        ]);
    }

    public function create(){
        $academicYears = Ajaran::where('status', 'aktif')->get();

        return view('back.harga.create', compact('academicYears'));
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'nominal'       => 'required|numeric|min:0',
            // 'ajaran_kode'   => 'required'
        ]);

        HargaSpp::create($data);

        // Redirect back to the create form with a success message
        return redirect()->route('Harga')->with('success', 'Data successfully added.');
    }

    public function edit($id_spp)
    {
        $spp = HargaSpp::findOrFail($id_spp);
        // $academicYears = Ajaran::where('status', 'aktif')->get();
        return view('back.harga.update', compact('spp', 'academicYears'));
    }

    public function update(Request $request, $id_spp)
    {
        $request->validate([
            'nominal' => 'required|string|max:255',
            // 'ajaran_kode' => 'required|string|max:255',
        ]);

        $spp = HargaSpp::findOrFail($id_spp);
        $spp->nominal = $request->nominal;
        // $spp->ajaran_kode = $request->ajaran_kode;
        $spp->save();

        return redirect()->route('Harga')->with('success', 'Data successfully updated.');
    }

    
    public function delete($id_spp)
    {
        $spp = HargaSpp::findOrFail($id_spp);
        $spp->delete();

        return redirect()->route('Harga')->with('success', 'Data successfully deleted.');
    }

    
}
