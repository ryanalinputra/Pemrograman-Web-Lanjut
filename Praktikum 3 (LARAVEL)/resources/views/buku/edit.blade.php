@extends('layouts.master')

@section('title', 'Aplikasi Toko Buku')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">

            <h4>Edit Data Buku</h4>
            <hr>

            <form action="{{ route('buku.update', $data->id) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="id">
                        Kode Buku
                    </label>

                    <input
                        class="form-control" type="text" name="id" id="id" value="{{ $data->id }}" readonly>
                </div>

                <div class="form-group mb-3">
                    <label for="nama_buku">
                        Nama Buku
                        <span class="text-danger">*</span>
                    </label>

                    <input class="form-control" type="text" name="nama_buku" id="nama_buku" value="{{ $data->nama_buku }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="kategori">
                        Kategori
                        <span class="text-danger">*</span>
                    </label>

                    <select class="form-control" name="kategori" id="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat -> id }}"
                            {{ $kat->id == $data->kategori_id ? 'selected' : ''}}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="harga">
                        Harga
                        <span class="text-danger">*</span>
                    </label>

                    <input class="form-control" type="number" name="harga" id="harga" value="{{ $data->harga }}" min="0" required>
                </div>

                <div class="form-group mb-3">
                    <label for="stock">
                        Stok
                        <span class="text-danger">*</span>
                    </label>

                    <input class="form-control" type="number" name="stock" id="stock" value="{{ $data->stock }}" min="0"required>
                </div>

                <div class="form-group mb-3">
                    <label for="image">Ganti Gambar Buku</label>
                    @if($data->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $data->image) }}" width="100" class="img-thumbnail" alt="Gambar Buku">
                        </div>
                    @endif
                    <input class="form-control" type="file" name="image" id="image" accept="image/*">
                </div>

                <br>

                <div>
                    <button type="submit" class="btn btn-primary">
                        Ubah
                    </button>

                    <a href="{{ url('tampil-buku') }}" class="btn btn-success">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
