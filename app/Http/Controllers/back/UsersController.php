<?php

namespace App\Http\Controllers\back;

use App\Http\{
    Controllers\Controller,
    Requests\User\UserCreateRequest,
    Requests\User\UserUpdateRequest
};

use App\Models\User;
use App\Models\Kelas;
use App\Models\Ajaran;
use Exception;
use Illuminate\{
    Support\Facades\Auth,
    Support\Facades\Hash,
    Support\Facades\DB,
    Support\Str,
};
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Termwind\Components\Dd;

class UsersController extends Controller
{
    public function index(Request $request) {
        $query = User::with(['ajaran', 'kelas']);
        
        // Mendapatkan semua role
        $roles = Role::all();
    
        // Mengambil nilai filter dari request
        $name = $request->input('name');
        $kelas_kode = $request->input('kelas_kode');
        $ajaran_kode = $request->input('ajaran_kode');
    
        // Menambahkan kondisi filter ke dalam query
        if ($name) {
            $query->where('name', 'LIKE', "%$name%");
        }
        if ($kelas_kode) {
            $query->where('kelas_kode', $kelas_kode);
        }
        if ($ajaran_kode) {
            $query->where('ajaran_kode', $ajaran_kode);
        }
    
        $users = $query->get();
        
        // Mengambil semua data kelas
        $kelas = Kelas::all();
        $ajaran = Ajaran::all();
        
        return view('back.user.index',[
            'users'     => $users,
            'roles'     => $roles,
            'kelas'     => $kelas, // Mengirim variabel $kelas ke view
            'ajaran'    => $ajaran
        ]);
    }
    
    
    

    public function create(){
        $classes = Kelas::all();
        $academicYears = Ajaran::all();
        $roles = Role::all();
    
        return view('back.user.create', compact('classes', 'academicYears', 'roles'));
    }
    

    public function store(Request $request) {
        // Validasi input termasuk file
        $validator = Validator::make($request->all(), [
            'nama'          => 'required',
            'nis'           => 'nullable',
            'email'         => 'required|email',
            'password'      => 'required',
            'telepon'       => 'required',
            'alamat'        => 'required',
            'kelas_kode'    => 'required',
            'ajaran_kode'   => 'required',
            'role'          => 'required',
            'foto_profile'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        $profile = $request->file('foto_profile');
        $filename = date('Y-m-d').$profile->getClientOriginalName();
        $path = 'foto_profile/'.$filename;
 
        Storage::disk('public')->put($path,file_get_contents($profile));

        // Mengambil data dari permintaan
        $data = [
            'name'              => $request->nama,
            'nis'              => $request->nis,
            'email'             => $request->email,
            'alamat'            => $request->alamat,
            'telepon'           => $request->telepon,
            'kelas_kode'           => $request->kelas_kode,
            'ajaran_kode'           => $request->ajaran_kode,
            'foto_profile'      => $filename,
            'password'          => Hash::make($request->password),
        ];
    
        // Membuat pengguna baru
        $user = User::create($data);
    
        // Menambahkan peran
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->assignRole($role);
        }
    
        return redirect()->route('Users');
    }

    public function edit(Request $request, $id){
        // Mengambil data pengguna
        $data = User::find($id); 
        if (!$data) {
            return redirect()->back()->with('error', 'User not found');
        }
    
        // Mengambil semua peran yang tersedia
        $roles = Role::all();
        $classes = Kelas::all();
        $academicYears = Ajaran::all();
    
        // Menentukan nilai yang dipilih sebelumnya
        $selectedClass = $data->kelas_kode;
        $selectedYear = $data->ajaran_kode;
        $selectedRole = $data->role; // Atau sesuaikan dengan bagaimana Anda menyimpan peran pengguna
    
        return view('back.user.update', compact('data', 'roles', 'classes', 'academicYears', 'selectedClass', 'selectedYear', 'selectedRole'));
    }
    

    public function update(Request $request, $id) {
        // Mengambil data pengguna yang akan diupdate
        $data = User::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'User not found');
        }

        // Memperbarui data pengguna
        $data->name = $request->nama;
        $data->nis = $request->nis;
        $data->email = $request->email;
        $data->alamat = $request->alamat;
        $data->telepon = $request->telepon;
        $data->kelas_kode = $request->kelas_kode;
        $data->ajaran_kode = $request->ajaran_kode;


        // Jika kata sandi tidak kosong, update juga kata sandi
        if (!empty($request->password)) {
            $data->password = Hash::make($request->password);
        }

        // Menyimpan foto profil jika diunggah
        $profile = $request->file('foto_profile');
        if ($profile) {
        // Delete previous photo if it exists
        if ($data->foto_profile) {
            Storage::disk('public')->delete('foto_profile/' . $data->foto_profile);
        }
    
        $filename = date('Y-m-d') . $profile->getClientOriginalName();
        $path = 'foto_profile/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($profile));

        $data->foto_profile = $filename;
        }

        // Save updated user data
        $data->save();

        // Menetapkan peran jika ada perubahan peran
        if ($request->has('role')) {
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $data->syncRoles([$role->name]); // Menghapus semua peran sebelumnya dan menetapkan peran baru
            }
        }

        return redirect()->route('Users');

    }

    public function delete(Request $request, $id){
        $data = User::find($id);

        if($data){
            $data->delete();
        }

        return redirect()->route('Users');
    }

    public function profile($id){
        $user = User::find($id);
    
        if (!$user) {
            // Jika pengguna tidak ditemukan, tampilkan pesan atau redirect ke halaman lain
            return redirect()->back()->with('error', 'User not found');
        }
        
        // Mendapatkan semua role
        $roles = Role::all();
        
        return view('back.profile.index', [
            'user' => $user, // Perbaiki 'users' menjadi 'user'
            'roles' => $roles
        ]);
    }

    public function updateProfile(Request $request, $id) {
        // Mengambil data pengguna yang akan diupdate
        $data = User::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'User not found');
        }

        // Memperbarui data pengguna
        $data->name = $request->nama;
        $data->email = $request->email;
        $data->alamat = $request->alamat;
        $data->telepon = $request->telepon;

        // Jika kata sandi tidak kosong, update juga kata sandi
        if (!empty($request->password)) {
            $data->password = Hash::make($request->password);
        }

        // Menyimpan foto profil jika diunggah
        $profile = $request->file('foto_profile');
        if ($profile) {
        // Delete previous photo if it exists
        if ($data->foto_profile) {
            Storage::disk('public')->delete('foto_profile/' . $data->foto_profile);
        }
    
        $filename = date('Y-m-d') . $profile->getClientOriginalName();
        $path = 'foto_profile/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($profile));

        $data->foto_profile = $filename;
        }

        // Save updated user data
        $data->save();

        // Menetapkan peran jika ada perubahan peran
        if ($request->has('role')) {
        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $data->syncRoles([$role->name]); // Menghapus semua peran sebelumnya dan menetapkan peran baru
            }
        }

        return redirect()->route('Profile', ['id' => $data->id]);
    }

}
