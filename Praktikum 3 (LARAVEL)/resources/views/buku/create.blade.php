@extends('layouts.master')
@section('title', 'Aplikasi Laravel')
@section('content')
<br>

<div class="container">
    <div class="row">
        <div class="col-md-6">

            <h4>Input Data Buku</h4>
            <hr>

            <form action="{{ route('buku.save') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="id">
                        Kode Buku
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        class="form-control" type="text" name="id" id="id" value="{{ old('id') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="nama_buku">
                        Nama Buku
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        class="form-control" type="text" name="nama_buku" id="nama_buku" value="{{ old('nama_buku') }}"
                        required
                    >
                </div>

                <div class="form-group mb-3">
                    <label for="kategori">
                        Kategori
                        <span class="text-danger">*</span>
                    </label>

                    <select class="form-control" name="kategori" id="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $category)
                            <option value="{{ $category -> id }}">
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="harga">
                        Harga
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        class="form-control" type="number" name="harga" id="harga" value="{{ old('harga') }}" min="0" required>
                </div>

                <div class="form-group mb-3">
                    <label for="stock">
                        Stok
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        class="form-control" type="number" name="stock" id="stock" value="{{ old('stock') }}" min="0" required>
                </div>

                <div class="form-group mb-3">
                    <label for="image">
                        Gambar Buku 
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        class="form-control" type="file" name="image" id="image" accept="image/*" required>
                </div>

                <br>

                <div>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="{{ url('tampil-buku') }}"
                        class="btn btn-success">
                        Kembali
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
