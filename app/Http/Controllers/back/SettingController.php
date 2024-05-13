<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index() {
        $setting = Setting::get()->first();
        return view('back.setting.index', [
            'setting' => $setting
        ]);
    }

    public function update(Request $request, $id) {
        $setting = Setting::find($id);
        if (!$setting) {
            return redirect()->back()->with('error', 'Setting not found');
        }
        
        // Memperbarui data pengguna
        $setting->nama = $request->nama;
        $setting->email = $request->email;
        $setting->alamat = $request->alamat;
        $setting->telepon = $request->telepon;
    
        // Menyimpan foto profil jika diunggah
        $logo = $request->file('path_logo');
        if ($logo) {
        // Delete previous logo if it exists
        if ($setting->path_logo) {
            Storage::disk('public')->delete('setting/' . $setting->path_logo);
        }

        $filename = date('Y-m-d') . $logo->getClientOriginalName();
        $path = 'setting/' . $filename;

        Storage::disk('public')->put($path, file_get_contents($logo));

        // Set the path_logo attribute to the filename
        $setting->path_logo = $filename;
        }
    
        // Save updated data
        $setting->save();
    
        return redirect()->route('Setting');
    }
}
