<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index(){
        $data = Buku::all();
        return view('buku.index', ['dataBuku' => $data]);
    }
    public function create(){
        return view('buku.create');
    }
    public function store(Request $request){
        $data = new Buku();
        $data->id = $request->id;
        $data->nama_buku = $request->nama_buku;
        $data->harga = $request->harga;
        $data->stock = $request->stock;
        $data->save();
        return redirect('/tampil-buku');
    }
    public function edit($id){
        $data = Buku::find($id);
        return view('buku.edit', compact('data'));
    }
    public function update(Request $request, $id){
        $data = Buku::find($id);
        $data->nama_buku = $request->nama_buku;
        $data->harga = $request->harga;
        $data->stock = $request->stock;
        $data->update();
        return redirect('/tampil-buku');
    }
    public function destroy($id){
        $data = Buku::find($id);
        $data->delete();
        return redirect('/tampil-buku');
    }
}
