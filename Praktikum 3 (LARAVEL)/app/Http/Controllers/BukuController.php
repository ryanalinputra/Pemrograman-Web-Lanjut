<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;

class BukuController extends Controller
{
    public function index(){
        $data = Buku::all();
        $kategori = Kategori::all();
        return view('buku.index', ['dataBuku' => $data, 'kategori' => $kategori]);
    }
    public function create(){
        $kategori = Kategori::all();
        return view('buku.create', compact('kategori'));
    }
    public function store(Request $request){
        $data = new Buku();
        $data->id = $request->id;
        $data->nama_buku = $request->nama_buku;
        $data->kategori_id = $request->kategori;
        $data->harga = $request->harga;
        $data->stock = $request->stock;
        $data->image = $request->file('image')->store('buku', 'public');
        $data->save();
        return redirect('/tampil-buku');
    }
    public function edit($id){
        $data = Buku::find($id);
        $kategori = Kategori::all();
        return view('buku.edit', compact('data', 'kategori'));
    }
    public function update(Request $request, $id){
        $data = Buku::find($id);
        $data->nama_buku = $request->nama_buku;
        $data->kategori_id = $request->kategori;
        $data->harga = $request->harga;
        $data->stock = $request->stock;
        if ($request->hasFile('image')) {
            $data->image = $request->file('image')->store('buku', 'public');
        }
        $data->update();
        return redirect('/tampil-buku');
    }
    public function destroy($id){
        $data = Buku::find($id);
        $data->delete();
        return redirect('/tampil-buku');
    }
}
