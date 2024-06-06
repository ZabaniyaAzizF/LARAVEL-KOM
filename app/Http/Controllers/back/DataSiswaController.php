<?php

namespace App\Http\Controllers\back;

use App\Models\DataSiswa;
use App\Models\Kelas;
use App\Http\Controllers\Controller;
use App\Models\Ajaran;
use App\Models\Tingkatan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DataSiswaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil ajaran yang memiliki status 'aktif'
        $ajaranAktif = Ajaran::where('status', 'aktif')->first();

        // Jika ada ajaran aktif, ambil data siswa yang terkait dengan ajaran aktif tersebut
        if ($ajaranAktif) {
            $siswa = DataSiswa::whereHas('kelas', function($query) use ($ajaranAktif) {
                $query->where('ajaran_kode', $ajaranAktif->kode_ajaran);
            })->get();
        } else {
            // Jika tidak ada ajaran aktif, kembalikan data siswa kosong
            $siswa = collect();
        }

        // Ambil semua data kelas dan ajaran
        $kelas = Kelas::all();
        $ajaran = Ajaran::all();

        // Kembalikan data ke view
        return view('back.siswa.index', [
            'data_siswa' => $siswa,
            'kelas' => $kelas,
            'ajaran' => $ajaran
        ]);
    }


    public function create()
    {
        $classes = Kelas::whereHas('ajaran', function($query) {
            $query->where('status', 'aktif');
        })->get();

        $academicYears = Ajaran::all();
    
        return view('back.siswa.create', compact('classes', 'academicYears'));
    }

    public function store(Request $request) {
        // Validasi input
        $validator = Validator::make($request->all(),[
            'nama'      => 'required',
            'nis'             => 'required',
            'kelas_kode'      => 'required',
            'telepon'         => 'required',
            'alamat'          => 'required',
        ]);
    
        // Jika validasi gagal, kembali dengan input dan error
        if ($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
    
        // Menyimpan data siswa
        $data = [
            'nama_siswa'   => $request->nama,
            'nis'          => $request->nis,
            'telepon'      => $request->telepon,
            'alamat'       => $request->alamat,
            'kelas_kode'   => $request->kelas_kode,
        ];
    
        DataSiswa::create($data);
    
        // Redirect ke halaman data siswa dengan pesan sukses
        return redirect()->route('Data-siswa')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $siswa = DataSiswa::findOrFail($id);
        $classes = Kelas::whereHas('ajaran', function($query) {
            $query->where('status', 'aktif');
        })->get();

        return view('back.siswa.update', [
            'siswa' => $siswa,
            'classes' => $classes,
        ]);
    }

    // Method untuk memperbarui data siswa
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_siswa' => 'required',
            'nis' => 'required',
            'kelas_kode' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        // Jika validasi gagal, kembali dengan input dan error
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Temukan data siswa berdasarkan ID
        $siswa = DataSiswa::findOrFail($id);

        // Update data siswa
        $siswa->update([
            'nama_siswa' => $request->nama_siswa,
            'nis' => $request->nis,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'kelas_kode' => $request->kelas_kode,
        ]);

        // Redirect ke halaman data siswa dengan pesan sukses
        return redirect()->route('Data-siswa')->with('success', 'Data siswa berhasil diperbarui');
    }

    public function delete(Request $request, $id){
        // Find the instance of Kelas
        $data = DataSiswa::find($id);
    
        // Jika data ditemukan, hapus
        if($data){
            $data->delete();
        }
    
        // Redirect ke route 'Data-kelas'
        return redirect()->route('Data-siswa');
    }

    public function view(Request $request, $kelasKode = null){
         // Prepare the query to get users with role 'siswa'
    $query = DataSiswa::with(['ajaran', 'kelas']);

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
        'data_siswa' => $siswa,
        'ajaran' => $ajaran,
        'tingkatan' => $tingkatan,
        'kelas' => $kelas,
    ]);
    }

    public function invoice(Request $request)
    {
        
    }


}
