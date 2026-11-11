<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PraktikumController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/polinema', function () {
//     return view('polinema');
// });
// Route::get('/lat', function () {
//     return view('latihan');
// });
// Route::get('/buku', function () {
//     return view('buku');
// });
// Route::get('/kategori', function () {
//     return view('kategori');
// });
// Route::get('/laporan', function () {
//     return view('laporan');
// });

Route::get('test', function() {
    return view('test', ['nama_saya' => 'Ryan']);
});

// Route::get('home', [PraktikumController::class, 'home']);
// Route::get('buku', [PraktikumController::class, 'buku']);
// Route::get('kategori', [PraktikumController::class, 'kategori']);
// Route::get('laporan', [PraktikumController::class, 'laporan']);
// Route::get('tampil-buku', [BukuController::class, 'index']);
// Route::get('tambah-buku', [BukuController::class, 'create'])->name('buku.add');
// Route::post('tampil-buku', [BukuController::class, 'store'])->name('buku.save');
// Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
// Route::put('/buku/edit/{id}', [BukuController::class, 'update'])->name('buku.update');
// Route::put('/buku/edit/{id}', [BukuController::class, 'update'])->name('buku.update');
// Route::post('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.delete');

Route::controller(PraktikumController::class)->group(function(){
    Route::get('home', 'home');
    Route::get('buku', 'buku');
    Route::get('kategori', 'kategori');
    Route::get('laporan', 'laporan');
});
Route::controller(BukuController::class)->group(function(){
    Route::get('tampil-buku', 'index');
    Route::get('tambah-buku', 'create')->name('buku.add');
    Route::post('tampil-buku', 'store')->name('buku.save');
    Route::get('/buku/edit/{id}', 'edit')->name('buku.edit');
    Route::put('/buku/edit/{id}', 'update')->name('buku.update');
    Route::post('/buku/delete/{id}', 'destroy')->name('buku.delete');
});
Route::controller(KategoriController::class)->group(function(){
    Route::get('tampil-kategori', 'index');
    Route::get('tambah-kategori', 'create')->name('kategori.add');
    Route::post('tampil-kategori', 'store')->name('kategori.save');
    Route::get('/kategori/edit/{id}', 'edit')->name('kategori.edit');
    Route::put('/kategori/edit/{id}', 'update')->name('kategori.update');
    Route::post('/kategori/delete/{id}', 'destroy')->name('kategori.delete');
});