<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Ajaran;
use App\Models\Kelas;
use App\Models\Metode;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pembayaran::with(['user', 'kelas']);
        $metode = Metode::all();

        if ($request->has('nis')) {
            $query->where('nis', 'like', '%' . $request->input('nis') . '%');
        }

        // Get the logged-in user
        $loggedInUser = Auth::user();

        $pembayaran = $query->get();

        return view('back.pembayaran.index', [
            'pembayaran' => $pembayaran,
            'metode' => $metode,
            'loggedInUser' => $loggedInUser // Make sure to pass the variable to the view
        ]);
    }

    // Display the edit form
    public function edit($kode_pembayaran)
    {
        $pembayaran = Pembayaran::with(['user', 'kelas'])->findOrFail($kode_pembayaran);

        // Get the logged-in user
        $loggedInUser = Auth::user();

        // Fetch class data from the 'kelas' table
        $kelasList = Kelas::all();

        return view('back.pembayaran.update', compact('pembayaran', 'loggedInUser', 'kelasList'));
    }


    public function update(Request $request, $kode_pembayaran)
    {
        $request->validate([
            'spp_bulan' => 'required|string|max:255',
            'jumlah' => 'required|string|max:255',
            'status' => 'required|in:lunas,belum lunas',
            'jenis' => 'required|string|max:255',
            'petugas' => 'required|string|max:255',
        ]);

        $pembayaran = Pembayaran::findOrFail($kode_pembayaran);
        $pembayaran->bulan = $request->input('spp_bulan');
        $pembayaran->nominal = $request->input('jumlah');
        $pembayaran->status = $request->input('status');
        $pembayaran->jenis = $request->input('jenis');
        $pembayaran->petugas = $request->input('petugas');

        $pembayaran->save();

        return redirect()->route('Pembayaran')->with('success', 'Pembayaran updated successfully');
    }




    

    public function history(Request $request)
    {
        // Mengambil ID pengguna yang sedang login
        $userId = auth()->id();
        
        // Mengambil data pembayaran yang terkait dengan pengguna yang sedang login dan memiliki status lunas
        $query = Pembayaran::where('user_id', $userId)
            ->where('status', 'lunas')
            ->with('ajaran'); // Eager load the related Ajaran model
    
        // Terapkan filter jika ada dalam request
        if ($request->filled('spp_bulan')) {
            $query->where('spp_bulan', $request->input('spp_bulan'));
        }
    
        if ($request->filled('tahun_ajaran')) {
            $query->whereHas('ajaran', function($query) use ($request) {
                $query->where('tahun_ajaran', $request->input('tahun_ajaran'));
            });
        }
    
        $pembayaran = $query->get();
        
        // Mengambil tahun ajaran yang tersedia
        $academicYears = Ajaran::distinct()->pluck('tahun_ajaran');
    
        // Mengembalikan view history beserta data pembayaran yang telah diambil
        return view('back.history.index', compact('pembayaran', 'academicYears'));
    }

    public function tunggakan(Request $request)
    {
        // Mengambil ID pengguna yang sedang login
        $userId = auth()->id();
        
        // Mengambil data pembayaran yang terkait dengan pengguna yang sedang login dan memiliki status lunas
        $query = Pembayaran::where('user_id', $userId)
            ->where('status', 'belum lunas')
            ->with('ajaran'); // Eager load the related Ajaran model
    
        // Terapkan filter jika ada dalam request
        if ($request->filled('spp_bulan')) {
            $query->where('spp_bulan', $request->input('spp_bulan'));
        }
    
        if ($request->filled('tahun_ajaran')) {
            $query->whereHas('ajaran', function($query) use ($request) {
                $query->where('tahun_ajaran', $request->input('tahun_ajaran'));
            });
        }
    
        $pembayaran = $query->get();
        
        // Mengambil tahun ajaran yang tersedia
        $academicYears = Ajaran::distinct()->pluck('tahun_ajaran');
    
        // Mengembalikan view history beserta data pembayaran yang telah diambil
        return view('back.history.tunggakan', compact('pembayaran', 'academicYears'));
    }

    public function invoice(Request $request)
    {
        $query = Pembayaran::with(['user', 'kelas']);
    
        $pembayaran = $query->get();
    
        return view('back.pembayaran.invoice', [
            'pembayaran' => $pembayaran
        ]);
    }

    public function invoiceH(Request $request)
    {
        // Mengambil ID pengguna yang sedang login
        $userId = auth()->id();
        
        // Mengambil data pembayaran yang terkait dengan pengguna yang sedang login dan memiliki status lunas
        $query = Pembayaran::where('user_id', $userId)
            ->where('status', 'lunas')
            ->with('ajaran'); // Eager load the related Ajaran model

        $pembayaran = $query->get();

        // Mengambil tahun ajaran yang tersedia
        $academicYears = Ajaran::distinct()->pluck('tahun_ajaran');

        // Mengembalikan view history beserta data pembayaran yang telah diambil
        return view('back.history.invoiceH', compact('pembayaran', 'academicYears'));
    }

    public function invoiceT(Request $request)
    {
        // Mengambil ID pengguna yang sedang login
        $userId = auth()->id();
        
        // Mengambil data pembayaran yang terkait dengan pengguna yang sedang login dan memiliki status lunas
        $query = Pembayaran::where('user_id', $userId)
            ->where('status', 'belum lunas')
            ->with('ajaran'); // Eager load the related Ajaran model
    
        $pembayaran = $query->get();
        
        // Mengambil tahun ajaran yang tersedia
        $academicYears = Ajaran::distinct()->pluck('tahun_ajaran');
    
        // Mengembalikan view history beserta data pembayaran yang telah diambil
        return view('back.history.invoiceT', compact('pembayaran', 'academicYears'));
    }
    
    
}
