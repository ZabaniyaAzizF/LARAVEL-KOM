<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('back.landingpage.index');
    }

    public function dashboard(){
        return view('back.dashboard.index');
    }

}
