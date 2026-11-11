@extends('layouts.master')

@section('title', 'Aplikasi Toko Buku')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">

            <h4>Edit Data Kategori</h4>
            <hr>

            <form action="{{ route('kategori.update', $data->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="id">
                        Kode Kategori
                    </label>

                    <input
                        class="form-control" type="text" name="id" id="id" value="{{ $data->id }}" readonly>
                </div>

                <div class="form-group mb-3">
                    <label for="nama_kategori">
                        Nama Kategori
                        <span class="text-danger">*</span>
                    </label>

                    <input class="form-control" type="text" name="nama_kategori" id="nama_kategori" value="{{ $data->nama_kategori }}" required>
                </div>

                <br>

                <div>
                    <button type="submit" class="btn btn-primary">
                        Ubah
                    </button>

                    <a href="{{ url('tampil-kategori') }}" class="btn btn-success">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

