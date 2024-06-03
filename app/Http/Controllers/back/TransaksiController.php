<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Ajaran;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;  
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;
use Spatie\Permission\Models\Role;

class TransaksiController extends Controller
{
    public function index()
    {
        // Fetch users with the 'Siswa' role
        $siswas = User::role('Siswa')->get();
        
        // Fetch class data from the 'kelas' table
        $kelasList = Kelas::all();

        // Fetch ajaran data from the 'ajaran' table
        $ajaranList = Ajaran::all();
        
        // Get the logged-in user
        $loggedInUser = Auth::user();

        return view('back.transaksi.index', compact('siswas', 'kelasList', 'ajaranList', 'loggedInUser'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa' => 'required|exists:users,id',
            'nis' => 'required',
            'jenis' => 'nullable',
            'ajaran_kode' => 'required|exists:ajaran,kode_ajaran',
            'bulan' => 'required',  
            'nominal' => 'required|numeric',
        ]);
    
        Pembayaran::create([
            'spp_bulan' => $request->bulan, // Changed to use the selected month
            'ajaran_kode' => $request->ajaran_kode,
            'user_id' => $request->siswa,
            'nis' => $request->nis,
            'kelas_kode' => $request->kelas, // Removed class association
            'jumlah' => $request->nominal,
            'jenis' => $request->jenis,
            'status' => 'belum lunas',
            'petugas' => Auth::user()->name,
        ]);
    
        return redirect()->route('Transaksi')->with('success', 'Pembayaran SPP berhasil ditambahkan');
    }
        
    
}