<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\{
    Http\Request,
    Support\Facades\Auth,
    Support\Facades\Hash
};
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function index(){
        return view('back.auth.login');
    }
    public function login_proses(Request $request){
        $request->validate([
            'email'    => 'required',
            'password' => 'required'
        ], [
            'email.required'    => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $data = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)){
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('failed','Email atau Password Anda Salah');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('landingpage');
    }

    public function register(){
        return view('back.auth.register');
    }

    public function register_proses(Request $request) {
        $request->validate([
            'nama'    => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required'
        ], [
            'nama.required'    => 'Nama wajib diisi',
            'email.required'    => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $data['name']       = $request->nama;
        $data['email']      = $request->email;
        $data['password']   = Hash::make($request->password);

        User::create($data);

        $login = [
            'name'      => $request->nama,
            'email'     => $request->email,
            'password'  => $request->password
        ];

        if (Auth::attempt($data)){
            return redirect()->route('register');
        } else {
            return redirect()->route('register')->with('failed','Email atau Password Anda Salah');
        }

    }
}
