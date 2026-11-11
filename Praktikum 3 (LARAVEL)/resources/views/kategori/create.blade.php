@extends('layouts.master')
@section('title', 'Aplikasi Laravel')
@section('content')
<br>

<div class="container">
    <div class="row">
        <div class="col-md-6">

            <h4>Input Data Kategori</h4>
            <hr>

            <form action="{{ route('kategori.save') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="id">
                        Kode Kategori
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        class="form-control" type="text" name="id" id="id" value="{{ old('id') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="nama_kategori">
                        Nama Kategori
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        class="form-control" type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}"
                        required
                    >
                </div>

                <br>

                <div>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="{{ url('tampil-kategori') }}"
                        class="btn btn-success">
                        Kembali
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

