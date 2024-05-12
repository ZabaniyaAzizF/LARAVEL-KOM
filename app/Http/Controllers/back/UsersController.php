<?php

namespace App\Http\Controllers\back;

use App\Http\{
    Controllers\Controller,
    Requests\User\UserCreateRequest,
    Requests\User\UserUpdateRequest
};

use App\Models\User;
use Exception;
use Illuminate\{
    Support\Facades\Auth,
    Support\Facades\Hash,
    Support\Facades\DB,
    Support\Str,
};
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Termwind\Components\Dd;

class UsersController extends Controller
{
    public function index() {
        $users = User::get();
        
        return view('back.user.index',[
            'users' => $users
        ]);
    }

    public function create(){
        $role = Role::get();
        return view('back.user.create', [
            'roles' => $role
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'email'     => 'required|email',
            'password'  => 'required',
            'telepon'   => 'required',
            'alamat'    => 'required',
            'role'      => 'required', // Menambahkan validasi untuk peran
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Mengambil data dari permintaan
        $data = [
            'name'      => $request->nama,
            'email'     => $request->email,
            'alamat'    => $request->alamat,
            'telepon'   => $request->telepon,
            'password'  => Hash::make($request->password),
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
    
        return view('back.user.update', compact('data', 'roles'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required',
            'email'     => 'required|email',
            'telepon'   => 'required',
            'alamat'    => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Mengambil data pengguna yang akan diupdate
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
    
        // Memperbarui data pengguna
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->telepon = $request->telepon;
        // Jika kata sandi tidak kosong, update juga kata sandi
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
    
        // Menetapkan peran jika ada perubahan peran
        if ($request->has('role')) {
            $role = Role::where('name', $request->role)->first();
            if ($role) {
                $user->syncRoles([$role->name]); // Menghapus semua peran sebelumnya dan menetapkan peran baru
            }
        }
    
        return redirect()->route('Users')->with('success', 'User has been updated');
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
            'users' => $user,
            'roles' => $roles
        ]);
    }

    public function updateProfile(){

    }

}
