<?php


use App\Http\Controllers\back\AuthController;
use App\Http\Controllers\back\AjaranController;
use App\Http\Controllers\back\UsersController;
use App\Http\Controllers\back\DataKelasController;
use App\Http\Controllers\back\DataSiswaController;
use App\Http\Controllers\back\DataPetugasController;
use App\Http\Controllers\back\RegisterController;
use App\Http\Controllers\back\HomeController;
use App\Http\Controllers\back\SettingController;
use App\Http\Controllers\back\TransaksiController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!  
|
*/

Route::get('/', [HomeController::class, 'index'] )->name('landingpage');

Route::get('/dashboard', function () {
    return view('back.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

//Login
Route::get('/login', [AuthController::class, 'index'] )->name('login');
Route::post('/login-proses', [AuthController::class, 'login_proses'] )->name('login-proses');

//Register
Route::get('/register', [AuthController::class, 'register'] )->name('register');
Route::post('/register-proses', [AuthController::class, 'register_proses'] )->name('register-proses');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'] )->name('logout');

    // users
    Route::get('/Users', [UsersController::class, 'index'] )->name('Users')->middleware(['auth', 'verified', 'permission:lihat-user']);
    Route::get('/Users/create', [UsersController::class, 'create'])->name('Users.tambah')->middleware(['auth', 'verified', 'permission:tambah-user']);
    Route::post('/Users/store', [UsersController::class, 'store'])->name('Users.store');
    Route::get('/Users/edit/{id}', [UsersController::class, 'edit'])->name('Users.edit')->middleware(['auth', 'verified', 'permission:edit-user']);
    Route::put('/Users/update/{id}', [UsersController::class, 'update'])->name('Users.update');
    Route::delete('/Users/delete/{id}', [UsersController::class, 'delete'])->name('Users.delete');
    Route::get('/Profile/{id}', [UsersController::class, 'profile'] )->name('Profile');
    Route::put('/Profile/update/{id}', [UsersController::class, 'updateProfile'])->name('Profile.update');

    //Tahun Ajaran
    Route::get('/Ajaran', [AjaranController::class, 'index'])->name('Ajaran');
    Route::get('/Ajaran/create', [AjaranController::class, 'create'])->name('Ajaran.tambah');
    Route::post('/Ajaran/store', [AjaranController::class, 'store'])->name('Ajaran.store');
    Route::get('/Ajaran/edit/{kode_ajaran}', [AjaranController::class, 'edit'])->name('Ajaran.edit');
    Route::put('/Ajaran/update/{kode_ajaran}', [AjaranController::class, 'update'])->name('Ajaran.update');
    Route::delete('/Ajaran/delete/{kode_ajaran} ', [AjaranController::class, 'delete'])->name('Ajaran.delete');

    // Data Kelas
    Route::get('/Data-kelas', [DataKelasController::class, 'index'] )->name('Data-kelas');
    Route::get('/Data-kelas/create', [DataKelasController::class, 'create'])->name('Data-kelas.tambah');
    Route::post('/Data-kelas/store', [DataKelasController::class, 'store'])->name('Data-kelas.store');
    Route::get('/Data-kelas/edit/{id_kelas}', [DataKelasController::class, 'edit'])->name('Data-kelas.edit');
    Route::put('/Data-kelas/update/{id_kelas}', [DataKelasController::class, 'update'])->name('Data-kelas.update');
    Route::delete('/Data-kelas/delete/{id_kelas}', [DataKelasController::class, 'delete'])->name('Data-kelas.delete');

    // Setting
    Route::get('/Setting', [SettingController::class, 'index'] )->name('Setting')->middleware(['auth', 'verified', 'permission:lihat-setting']);
    Route::put('/Setting/update/{id_setting}', [SettingController::class, 'update'])->name('Setting.update')->middleware(['auth', 'verified', 'permission:edit-setting']);

    // Transaksi
    Route::get('/Transaksi', [TransaksiController::class, 'index'] )->name('Transaksi');
    Route::get('/Transaksi/store', [TransaksiController::class, 'store'] )->name('Transaksi.store');

    // History
    Route::get('/History', [TransaksiController::class, 'history'] )->name('History');

});

    // // Data Siswa
    // Route::get('/Data-siswa', [UsersController::class, 'siswa'] )->name('Data-siswa');
    // Route::get('/Data-siswa/create', [DataSiswaController::class, 'create'])->name('Data-siswa.tambah');
    // Route::post('/Data-siswa/store', [DataSiswaController::class, 'store'])->name('Data-siswa.store');
    // Route::get('/Data-siswa/edit/{nis}', [DataSiswaController::class, 'edit'])->name('Data-siswa.edit');
    // Route::put('/Data-siswa/update/{nis}', [DataSiswaController::class, 'update'])->name('Data-siswa.update');
    // Route::delete('/Data-siswa/delete/{nis}', [DataSiswaController::class, 'delete'])->name('Data-siswa.delete');

    // // Data Petugas
    // Route::get('/Data-petugas', [UsersController::class, 'petugas'] )->name('Data-petugas');
    // Route::get('/Data-petugas/create', [DataPetugasController::class, 'create'])->name('Data-petugas.tambah');
    // Route::post('/Data-petugas/store', [DataPetugasController::class, 'store'])->name('Data-petugas.store');
    // Route::get('/Data-petugas/edit/{kode_petugas}', [DataPetugasController::class, 'edit'])->name('Data-petugas.edit');
    // Route::put('/Data-petugas/update/{kode_petugas}', [DataPetugasController::class, 'update'])->name('Data-petugas.update');
    // Route::delete('/Data-petugas/delete/{kode_petugas}', [DataPetugasController::class, 'delete'])->name('Data-petugas.delete');
