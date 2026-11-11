<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PraktikumController extends Controller
{
    public function home(){
        return view('home');
    }
    public function buku(){
        return view('buku');
    }
    public function kategori(){
        return view('kategori');
    }
    public function laporan(){
        return view('laporan');
    }
}
