@extends('layouts.master')

@section('judul', 'Detail Penjualan')

@section('content')
<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>Detail Penjualan</h3>
            <p class="text-muted">
                Rincian barang dan pembayaran transaksi.
            </p>
        </div>

        <a href="{{ route('penjualan.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <!-- Informasi Transaksi -->
    <div class="card mb-4">
        <div class="card-header">
            Informasi Transaksi
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <strong>Nomor Transaksi:</strong>
                    TRX-{{ str_pad($penjualan->id, 4, '0', STR_PAD_LEFT) }}
                </div>

                <div class="col-md-6 mb-2">
                    <strong>Tanggal:</strong>
                    {{ \Carbon\Carbon::parse($penjualan->tanggal)->format('d-m-Y H:i') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Produk -->
    <div class="card mb-4">
        <div class="card-header">
            Daftar Produk yang Dibeli
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($penjualan->detail as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $item->buku->nama_buku ?? 'Produk tidak tersedia' }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>

                                <td>{{ $item->qty }}</td>

                                <td>
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Rincian Pembayaran -->
    <div class="card mb-4">
        <div class="card-header">
            Rincian Pembayaran
        </div>

        <div class="card-body">
            <div class="row justify-content-end">
                <div class="col-md-5">
                    <table class="table">
                        <tr>
                            <td>Subtotal</td>
                            <td class="text-end">
                                Rp {{ number_format($penjualan->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <td>Diskon</td>
                            <td class="text-end">
                                Rp {{ number_format($penjualan->diskon, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Total Pembayaran</th>
                            <th class="text-end">
                                Rp {{ number_format($penjualan->total, 0, ',', '.') }}
                            </th>
                        </tr>

                        <tr>
                            <td>Uang Bayar</td>
                            <td class="text-end">
                                Rp {{ number_format($penjualan->bayar, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Kembalian</th>
                            <th class="text-end text-success">
                                Rp {{ number_format($penjualan->kembalian, 0, ',', '.') }}
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('penjualan.index') }}"
       class="btn btn-secondary">
        Kembali ke Riwayat Transaksi
    </a>

</div>
@endsection
