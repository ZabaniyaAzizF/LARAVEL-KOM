<?php

namespace App\Http\Controllers\back;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Ajaran;
use Illuminate\Http\Request;
use App\Models\DataSiswa;
use App\Models\HargaSpp;
use App\Models\Kelas;
use App\Models\Metode;
use App\Models\Pembayaran;
use App\Models\Tingkatan;

class TransaksiController extends Controller
{
    // app/Http/Controllers/TransaksiController.php

    public function index()
    {
        // Fetch users with the 'Siswa' role along with their class and grade level information
        $siswas = DataSiswa::with(['kelas.tingkatan', 'kelas.ajaran'])->get();
    
        // Fetch class data from the 'kelas' table
        $kelasList = Kelas::all();
    
        // Fetch class data from the 'kelas' table
        $tingkatanList = Tingkatan::all();
    
        // Fetch ajaran data from the 'ajaran' table
        $ajaranList = Ajaran::all();
    
        // Fetch nominal data based on metode_kode
        $nominalByMetode = HargaSPP::pluck('nominal', 'metode_kode');
    
        // Fetch data from the 'metode' table
        $metodeList = Metode::all();
    
        // Get the logged-in user
        $loggedInUser = Auth::user();
    
        return view('back.transaksi.index', compact('siswas', 'kelasList', 'ajaranList', 'tingkatanList', 'loggedInUser', 'metodeList', 'nominalByMetode'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_pembayaran' => 'required',
            'nama_siswa' => 'required',
            'nis' => 'required',
            'kelas' => 'required',
            'jenis' => 'required',
            'bulan' => 'required',
            'nominal' => 'required',
            'petugas' => 'required',
        ]);
    
        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Simpan data pembayaran
        $data['kode_pembayaran']           = $request->kode_pembayaran;
        $data['nama_siswa']                = $request->nama_siswa;
        $data['nis']                       = $request->nis;
        $data['kelas']                     = $request->kelas;
        $data['metode_kode']               = $request->jenis;
        $data['bulan']                     = $request->bulan;
        $data['nominal']                   = $request->nominal;
        $data['petugas']                   = $request->petugas;
    
        Pembayaran::create($data);
    
        return redirect()->route('Transaksi')->with('success', 'Data pembayaran berhasil disimpan');
    }


    
}