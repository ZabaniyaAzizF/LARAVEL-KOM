<?php

namespace App\Http\Controllers\back;

use App\Models\HargaSpp;
use App\Models\Ajaran;
use App\Models\Metode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HargaController extends Controller
{
    public function index(){
        $harga = HargaSpp::all();
        $ajaran = Ajaran::where('status', 'aktif')->get();
        $metode = Metode::all();
        
        return view('back.harga.index', [
            'harga_spp' => $harga,
            'ajaran' => $ajaran
        ]);
    }

    public function create(){
        $harga = HargaSpp::all();
        $metode = Metode::all();
        $ajaran = Ajaran::where('status', 'aktif')->get();

        return view('back.harga.create', compact('ajaran', 'metode', 'harga'));
    }

    
    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nominal' => 'required|numeric',
            'ajaran_kode' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        // Buat instance HargaSpp dan simpan data ke database
        HargaSpp::create([
            'nominal' => $request->nominal,
            'ajaran_kode' => $request->ajaran_kode,
            'metode_kode' => $request->metode_pembayaran,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('Harga')->with('success', 'Data Harga SPP berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id_spp)
    {
        $harga = HargaSpp::findOrFail($id_spp);
        $ajaran = Ajaran::where('status', 'aktif')->get();
        $metode = Metode::all();
        
        return view('back.harga.update', compact('harga', 'ajaran', 'metode'));
    }

    // Memperbarui data yang ada
    public function update(Request $request, $id_spp)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'nominal' => 'required|numeric',
            'ajaran_kode' => 'required|exists:ajaran,kode_ajaran',
            'metode_pembayaran' => 'required|exists:metode,kode_metode',
        ]);

        // Temukan data berdasarkan ID dan update
        $harga = HargaSpp::findOrFail($id_spp);
        $harga->update([
            'nominal' => $request->nominal,
            'ajaran_kode' => $request->ajaran_kode,
            'metode_kode' => $request->metode_pembayaran,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('Harga')->with('success', 'Data Harga SPP berhasil diperbarui.');
    }

    
    public function delete($id_spp)
    {
        $spp = HargaSpp::findOrFail($id_spp);
        $spp->delete();

        return redirect()->route('Harga')->with('success', 'Data successfully deleted.');
    }

    public function invoice(){
        $harga = HargaSpp::all();
        $ajaran = Ajaran::where('status', 'aktif')->get();
        $metode = Metode::all();
        
        return view('back.harga.invoice', [
            'harga_spp' => $harga,
            'ajaran' => $ajaran
        ]);
    }
    
}
