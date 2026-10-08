<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/polinema', function () {
    return view('polinema');
});
Route::get('/lat', function () {
    return view('latihan');
});
Route::get('/buku', function () {
    return view('buku');
});
Route::get('/kategori', function () {
    return view('kategori');
});
Route::get('/laporan', function () {
    return view('laporan');
});