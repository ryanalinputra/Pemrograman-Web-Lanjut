@extends('layouts.master')

@section('judul', 'Riwayat Transaksi')

@section('content')
<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3>Riwayat Transaksi</h3>
            <p class="text-muted">
                Daftar transaksi penjualan yang telah dilakukan.
            </p>
        </div>

        <a href="{{ route('kasir.index') }}" class="btn btn-primary">
            <i class="bi bi-cart"></i> Kembali ke Kasir
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>No. Transaksi</th>
                            <th>Tanggal</th>
                            <th>Subtotal</th>
                            <th>Diskon</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($penjualan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    TRX-{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y H:i') }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->diskon, 0, ',', '.') }}
                                </td>

                                <td>
                                    <strong>
                                        Rp {{ number_format($item->total, 0, ',', '.') }}
                                    </strong>
                                </td>

                                <td>
                                    <a href="{{ route('penjualan.detail', $item->id) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    Belum ada transaksi penjualan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
