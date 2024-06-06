<?php

namespace App\Http\Controllers\back;

use App\Models\DataSiswa;
use App\Models\User;
use App\Models\Kelas;
use App\Http\Controllers\Controller;
use App\Models\Ajaran;
use App\Models\Tingkatan;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    public function index(Request $request)
{
    // Prepare the query to get users with role 'siswa'
    $query = User::with(['ajaran', 'kelas'])->role('siswa');

    // Retrieve filter values from the request
    $kelasKode = $request->input('kelas_kode');

    // Add filter conditions to the query
    if ($kelasKode) {
        $query->where('kelas_kode', $kelasKode);
    }

    // Retrieve filtered students
    $siswa = $query->get();

    // Retrieve all classes, ajaran, and tingkatan
    $kelas = Kelas::all();
    $ajaran = Ajaran::all();
    $tingkatan = Tingkatan::all();

    // Return the view with the retrieved data
    return view('back.siswa.index', [
        'users' => $siswa,
        'ajaran' => $ajaran,
        'tingkatan' => $tingkatan,
        'kelas' => $kelas,
    ]);
}
    public function create()
    {
        return view('back.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'nis' => 'required',
            'kelas_kode' => 'required',
        ]);

        $siswa = DataSiswa::create([
            'nama_siswa' => $request->nama_siswa,
            'nis' => $request->nis,
            'kelas_kode' => $request->kelas_kode,
        ]);

        // Tetapkan role default 'siswa'
        $siswa->assignRole('siswa');

        return redirect()->route('Data-siswa')->with('success', 'Siswa berhasil ditambahkan dan role telah ditetapkan');
    }

public function view(Request $request, $kelasKode = null){
    // Prepare the query to get users with role 'siswa'
    $query = User::with(['ajaran', 'kelas'])->role('siswa');

    // Add filter conditions to the query based on $kelasKode
    if ($kelasKode) {
        $query->whereHas('kelas', function ($query) use ($kelasKode) {
            $query->where('kode_kelas', $kelasKode);
        });
    }

    // Retrieve filtered students
    $siswa = $query->get();

    // Check if the filtered students are empty
    if ($siswa->isEmpty()) {
        // Redirect to the desired URL if no students are found
        return redirect()->route('Data-siswa.view', ['kode_kelas' => $kelasKode ]);
    }

    // Retrieve all classes, ajaran, and tingkatan
    $kelas = Kelas::all();
    $ajaran = Ajaran::all();
    $tingkatan = Tingkatan::all();

    // Return the view with the retrieved data
    return view('back.siswa.views', [
        'users' => $siswa,
        'ajaran' => $ajaran,
        'tingkatan' => $tingkatan,
        'kelas' => $kelas,
    ]);
}

public function invoice(Request $request)
{
    // Prepare the query to get users with role 'siswa'
    $query = User::with(['ajaran', 'kelas'])->role('siswa');

    // Retrieve filter values from the request
    $kelasKode = $request->input('kelas_kode');

    // Retrieve filtered students
    $siswa = $query->get();

    // Retrieve all classes, ajaran, and tingkatan
    $kelas = Kelas::all();
    $ajaran = Ajaran::all();
    $tingkatan = Tingkatan::all();

    // Return the view with the retrieved data
    return view('back.siswa.invoice', [
        'users' => $siswa,
        'ajaran' => $ajaran,
        'tingkatan' => $tingkatan,
        'kelas' => $kelas,
    ]);
}


}
