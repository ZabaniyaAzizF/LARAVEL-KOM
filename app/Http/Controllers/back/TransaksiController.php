<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
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
        
        // Get the logged-in user
        $loggedInUser = Auth::user();

        return view('back.transaksi.index', compact('siswas', 'kelasList', 'loggedInUser'));
    }

    public function store(Request $request)
{
    $request->validate([
        'siswa' => 'required|exists:users,id',
        'nis' => 'required',
        'jenis' => 'nullable',
        'kelas' => 'required|exists:kelas,kode_kelas',
        'nominal' => 'required|numeric',
    ]);

    Pembayaran::create([
        'spp_bulan' => now()->format('m'),
        'ajaran_kode' => '2023/2024', // Replace with your logic
        'user_id' => $request->siswa,
        'nis' => $request->nis, // Add this line
        'kelas_kode' => $request->kelas,
        'jumlah' => $request->nominal,
        'jenis' => $request->jenis,
        'status' => 'belum lunas', // Or any default status
        'petugas' => Auth::user()->name,
    ]);

    return redirect()->route('Transaksi')->with('success', 'Pembayaran SPP berhasil ditambahkan');
}


    // public function history()
    // {
    //     // Ambil pengguna yang sedang login
    //     $loggedInUser = Auth::user();
        
    //     // Pastikan pengguna memiliki peran 'Siswa' dan ambil data pembayaran terkait
    //     if ($loggedInUser->hasRole('Siswa')) {
    //         $pembayarans = Pembayaran::where('user_id', $loggedInUser->id)
    //                                  ->orderBy('id_pembayaran', 'desc')
    //                                  ->paginate(10);
    //     } else {
    //         // Jika pengguna bukan 'Siswa', tidak menampilkan data atau sesuaikan dengan kebutuhan Anda
    //         $pembayarans = collect(); // Kosongkan koleksi pembayaran
    //     }
    
    //     // Kirimkan data tersebut ke view
    //     return view('back.history.index', compact('pembayarans', 'loggedInUser'));
    // }
    
    
    
    
    
}