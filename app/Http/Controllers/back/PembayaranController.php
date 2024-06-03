<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Ajaran;
use App\Models\Kelas;
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
        
        if ($request->has('name')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('name') . '%');
            });
        }
    
        $pembayaran = $query->get();
    
        return view('back.pembayaran.index', [
            'pembayaran' => $pembayaran
        ]);
    }

    // Display the edit form
    public function edit($id_pembayaran)
    {
        $pembayaran = Pembayaran::with(['user', 'kelas'])->findOrFail($id_pembayaran);

        // Get the logged-in user
        $loggedInUser = Auth::user();

        // Fetch class data from the 'kelas' table
        $kelasList = Kelas::all();

        return view('back.pembayaran.update', compact('pembayaran', 'loggedInUser', 'kelasList'));
    }


    // Handle the update request
    public function update(Request $request, $id_pembayaran)
    {
        // Debugging: Check request data
        // dd($request->all());
    
        $request->validate([
            'spp_bulan' => 'required|string|max:255',
            'jumlah' => 'required|string|max:255',
            'status' => 'required|in:lunas,belum lunas',
            'jenis' => 'required|string|max:255'
        ]);
    
        // Debugging: Check if the record is found
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);
        // dd($pembayaran);
    
        $pembayaran->spp_bulan = $request->input('spp_bulan');
        $pembayaran->jumlah = $request->input('jumlah');
        $pembayaran->status = $request->input('status');
        $pembayaran->jenis = $request->input('jenis');
        $pembayaran->petugas = $request->input('petugas'); // Include this line to update the "petugas" field
    
        // Debugging: Check the updated model before saving
        // dd($pembayaran);
    
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
