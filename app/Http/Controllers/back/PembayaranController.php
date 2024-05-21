<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
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

        // Assuming you have a model named 'Siswa', fetch the data of all siswas
        $siswas = Siswa::all();

        return view('back.pembayaran.update', compact('pembayaran', 'loggedInUser', 'siswas', 'kelasList'));
    }


    // Handle the update request
    public function update(Request $request, $id_pembayaran)
    {
        $request->validate([
            'spp_bulan' => 'required|string|max:255',
            'jumlah' => 'required|string|max:255',
            'status' => 'required|in:lunas,belum lunas'
        ]);

        $pembayaran = Pembayaran::findOrFail($id_pembayaran);
        $pembayaran->spp_bulan = $request->input('spp_bulan');
        $pembayaran->jumlah = $request->input('jumlah');
        $pembayaran->status = $request->input('status');
        $pembayaran->petugas = $request->input('petugas'); // Include this line to update the "petugas" field
        $pembayaran->save();

        return redirect()->route('Pembayaran')->with('success', 'Pembayaran updated successfully');
    }
    
    
}
