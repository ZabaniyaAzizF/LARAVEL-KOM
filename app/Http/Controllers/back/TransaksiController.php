<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(){
        return view('back.transaksi.index');
    }

    public function store(){

    }

    public function history() {
        return view('back.history.index');
    }
}
