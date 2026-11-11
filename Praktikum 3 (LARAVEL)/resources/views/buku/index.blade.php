@extends('layouts.master')
@section('title', 'Aplikasi Toko Baru')
@section('content')
<div class="container">
    <h2>Table Buku</h2>
    <a href="{{ route('buku.add') }}" class="btn btn-success mb-3">
      +Tambah Data  
    </a>
    <table class="table table-bordered table-striped" id="tabel-produk">
        <thead>
            <tr>
                <th style="width: 1%;">No.</th>
                <th style="width: 15%;">Kode Buku</th>
                <th style="width: 25%;">Nama Buku</th>
                <th style="width: 15%;">Harga</th>
                <th style="width: 10%;">Stock</th>
                <th style="width: 20%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataBuku as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->id }}</td>
                <td>{{ $data->nama_buku }}</td>
                <td>{{ number_format($data->harga, 0, ',', '.') }}</td>
                <td>{{ $data->stock }}</td>
                <td>
                    <form action="{{ route('buku.delete', $data->id) }}" method="POST">
                        @csrf
                        <a href="{{ route('buku.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($dataBuku->isEmpty())
            <tr>
                <td colspan="6" class="text-center">
                    Belum ada data buku.
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection