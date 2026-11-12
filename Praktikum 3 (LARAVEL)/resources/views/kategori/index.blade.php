@extends('layouts.master')
@section('title', 'Aplikasi Toko Baru')
@section('content')
<div class="container">
    <h2>Table Kategori</h2>
    <a href="{{ route('kategori.add') }}" class="btn btn-success mb-3">
      +Tambah Data  
    </a>
    <table class="table table-bordered table-striped align-middle text-center" id="tabel-kategori">
        <thead>
            <tr>
                <th style="width: 1%;">No.</th>
                <th style="width: 20%;">Kode Kategori</th>
                <th style="width: 50%;">Nama Kategori</th>
                <th style="width: 29%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataKategori as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->id }}</td>
                <td>{{ $data->nama_kategori }}</td>
                <td>
                    <form action="{{ route('kategori.delete', $data->id) }}" method="POST" class="m-0">
                        @csrf
                        <a href="{{ route('kategori.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($dataKategori->isEmpty())
            <tr>
                <td colspan="4" class="text-center">
                    Belum ada data kategori.
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection

