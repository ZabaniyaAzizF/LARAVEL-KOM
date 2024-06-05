<?php


use App\Http\Controllers\back\AuthController;
use App\Http\Controllers\back\AjaranController;
use App\Http\Controllers\back\UsersController;
use App\Http\Controllers\back\TingkatController;
use App\Http\Controllers\back\HargaController;
use App\Http\Controllers\back\MetodeController;
use App\Http\Controllers\back\DataKelasController;
use App\Http\Controllers\back\PembayaranController;
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
    Route::get('/Users/invoice', [UsersController::class, 'invoice'] )->name('Users.invoice')->middleware(['auth', 'verified', 'permission:invoice-user']);

    //Prodile
    Route::get('/Profile/{id}', [UsersController::class, 'profile'] )->name('Profile');
    Route::put('/Profile/update/{id}', [UsersController::class, 'updateProfile'])->name('Profile.update');

    //Tahun Ajaran
    Route::get('/Ajaran', [AjaranController::class, 'index'])->name('Ajaran')->middleware(['auth', 'verified', 'permission:lihat-ajaran']);
    Route::get('/Ajaran/create', [AjaranController::class, 'create'])->name('Ajaran.tambah')->middleware(['auth', 'verified', 'permission:tambah-ajaran']);
    Route::post('/Ajaran/store', [AjaranController::class, 'store'])->name('Ajaran.store');
    Route::get('/Ajaran/edit/{kode_ajaran}', [AjaranController::class, 'edit'])->name('Ajaran.edit')->middleware(['auth', 'verified', 'permission:edit-ajaran']);
    Route::put('/Ajaran/update/{kode_ajaran}', [AjaranController::class, 'update'])->name('Ajaran.update');
    Route::delete('/Ajaran/delete/{kode_ajaran} ', [AjaranController::class, 'delete'])->name('Ajaran.delete');
    Route::get('/Ajaran/invoice', [AjaranController::class, 'invoice'] )->name('Ajaran.invoice')->middleware(['auth', 'verified', 'permission:invoice-ajaran']);

    // Data Kelas
    Route::get('/Data-kelas', [DataKelasController::class, 'index'] )->name('Data-kelas')->middleware(['auth', 'verified', 'permission:lihat-kelas']);
    Route::get('/Data-kelas/create', [DataKelasController::class, 'create'])->name('Data-kelas.tambah')->middleware(['auth', 'verified', 'permission:tambah-kelas']);
    Route::post('/Data-kelas/store', [DataKelasController::class, 'store'])->name('Data-kelas.store');
    Route::get('/Data-kelas/edit/{id_kelas}', [DataKelasController::class, 'edit'])->name('Data-kelas.edit')->middleware(['auth', 'verified', 'permission:edit-kelas']);
    Route::put('/Data-kelas/update/{id_kelas}', [DataKelasController::class, 'update'])->name('Data-kelas.update');
    Route::delete('/Data-kelas/delete/{id_kelas}', [DataKelasController::class, 'delete'])->name('Data-kelas.delete');
    Route::get('/Data-kelas/invoice', [DataKelasController::class, 'invoice'] )->name('Data-kelas.invoice')->middleware(['auth', 'verified', 'permission:invoice-ajaran']);

    // Data Siswa
    Route::get('/Data-siswa', [DataSiswaController::class, 'index'] )->name('Data-siswa');
    Route::get('/Data-siswa/{kode_kelas}', [DataSiswaController::class, 'view'] )->name('Data-siswa.view');


    // Setting
    Route::get('/Setting', [SettingController::class, 'index'] )->name('Setting')->middleware(['auth', 'verified', 'permission:lihat-setting']);
    Route::put('/Setting/update/{id_setting}', [SettingController::class, 'update'])->name('Setting.update')->middleware(['auth', 'verified', 'permission:edit-setting']);

    // Transaksi
    Route::get('/Transaksi', [TransaksiController::class, 'index'] )->name('Transaksi')->middleware(['auth', 'verified', 'permission:lihat-bulanan']);
    Route::post('/Transaksi/store', [TransaksiController::class, 'store'])->name('Transaksi.store');

    // Pembayaran
    Route::get('/Pembayaran', [PembayaranController::class, 'index'])->name('Pembayaran')->middleware(['auth', 'verified', 'permission:lihat-bayaran']);
    Route::get('/Pembayaran/edit/{id_pembayaran}', [PembayaranController::class, 'edit'])->name('Pembayaran.edit')->middleware(['auth', 'verified', 'permission:edit-bayaran']);
    Route::put('/Pembayaran/update/{id_pembayaran}', [PembayaranController::class, 'update'])->name('Pembayaran.update');
    Route::get('/Pembayaran/invoice', [PembayaranController::class, 'invoice'] )->name('Pembayaran.invoice')->middleware(['auth', 'verified', 'permission:invoice-bayaran']);

    // Tingkatan
    Route::get('/Tingkatan', [TingkatController::class, 'index'] )->name('Tingkatan')->middleware(['auth', 'verified', 'permission:lihat-tingkat']);
    Route::get('/Tingkatan/create', [TingkatController::class, 'create'] )->name('Tingkatan.tambah')->middleware(['auth', 'verified', 'permission:tambah-tingkat']);
    Route::post('/Tingkatan/store', [TingkatController::class, 'store'] )->name('Tingkatan.store');
    Route::get('/Tingkatan/edit/{kode_tingkat}', [TingkatController::class, 'edit'] )->name('Tingkatan.edit')->middleware(['auth', 'verified', 'permission:edit-tingkat']);
    Route::put('/Tingkatan/update/{kode_tingkat}', [TingkatController::class, 'update'] )->name('Tingkatan.update');
    Route::delete('/Tingkatan/delete/{kode_tingkat}', [TingkatController::class, 'delete'] )->name('Tingkatan.delete');
    Route::get('/Tingkatan/invoice', [TingkatController::class, 'invoice'] )->name('Tingkatan.invoice')->middleware(['auth', 'verified', 'permission:invoice-tingkat']);

    // Metode Pembayaran
    Route::get('/Metode', [MetodeController::class, 'index'] )->name('Metode');
    Route::get('/Metode/create', [MetodeController::class, 'create'] )->name('Metode.tambah');
    Route::post('/Metode/store', [MetodeController::class, 'store'] )->name('Metode.store');
    Route::get('/Metode/edit/{id_spp}', [MetodeController::class, 'edit'])->name('Metode.edit');
    Route::put('/Metode/update/{id_spp}', [MetodeController::class, 'update'])->name('Metode.update');    
    Route::delete('/Metode/delete/{id_spp}', [MetodeController::class, 'delete'] )->name('Metode.delete');
    Route::get('/Metode/invoice', [MetodeController::class, 'invoice'] )->name('Metode.invoice');

    // Harga Spp
    Route::get('/Harga', [HargaController::class, 'index'] )->name('Harga');
    Route::get('/Harga/create', [HargaController::class, 'create'] )->name('Harga.tambah');
    Route::post('/Harga/store', [HargaController::class, 'store'] )->name('Harga.store');
    Route::get('/Harga/edit/{id_spp}', [HargaController::class, 'edit'])->name('Harga.edit');
    Route::put('/Harga/update/{id_spp}', [HargaController::class, 'update'])->name('Harga.update');    
    Route::delete('/Harga/delete/{id_spp}', [HargaController::class, 'delete'] )->name('Harga.delete');
    Route::get('/Harga/invoice', [HargaController::class, 'invoice'] )->name('Harga.invoice');


    // History  Pembayaran
    Route::get('/History', [PembayaranController::class, 'history'] )->name('History')->middleware(['auth', 'verified', 'permission:lihat-history']);
    Route::get('/History/invoice', [PembayaranController::class, 'invoiceH'] )->name('History.invoice');

    // Tunggakan
    Route::get('/Tunggakan', [PembayaranController::class, 'tunggakan'] )->name('Tunggakan')->middleware(['auth', 'verified', 'permission:lihat-tunggakan']);
    Route::get('/Tunggkan/invoice', [PembayaranController::class, 'invoiceT'] )->name('Tunggakan.invoice');

});

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
