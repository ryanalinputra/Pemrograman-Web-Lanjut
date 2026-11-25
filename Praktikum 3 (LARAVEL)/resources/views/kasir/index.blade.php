@extends('layouts.master')

@section('judul', 'Kasir')

@section('content')
<div class="container-fluid mt-4">

    <!-- JUDUL HALAMAN -->
    <div class="mb-4">
        <h3>Kasir</h3>
        <p class="text-muted">Home / Kasir</p>
    </div>

    <!-- PESAN SUKSES -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- PESAN ERROR -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kasir.checkout') }}"
          method="POST"
          id="formKasir">

        @csrf

        <div class="row">

            <!-- BAGIAN KIRI: untuk pencarian produk -->
            <div class="col-md-5">

                <div class="card shadow-sm mb-3">

                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Pilih Produk</h5>
                    </div>

                    <div class="card-body">

                        <label class="form-label">
                            Cari Nama Produk
                        </label>

                        <input type="text"
                               id="cariProduk"
                               class="form-control"
                               placeholder="Ketik nama buku...">

                        <!-- Hasil pencarian -->
                        <div id="hasilPencarian" class="mt-3">
                            <p class="text-muted text-center">
                                Ketik nama produk untuk mencari.
                            </p>
                        </div>

                    </div>
                </div>

            </div>

            <!-- BAGIAN KANAN: keranjang -->
            <div class="col-md-7">

                <div class="card shadow-sm mb-3">

                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Keranjang Belanja</h5>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">

                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th width="100">Qty</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="keranjang">
                                    <tr>
                                        <td colspan="6"
                                            class="text-center text-muted">
                                            Keranjang masih kosong
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                        </div>

                    </div>
                </div>

                <!-- BAGIAN PEMBAYARAN -->
                <div class="card shadow-sm mb-3">

                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Pembayaran</h5>
                    </div>

                    <div class="card-body">

                        <!-- SUBTOTAL -->
                        <div class="mb-3">
                            <label class="form-label">
                                Subtotal
                            </label>

                            <input type="text"
                                   id="subtotal"
                                   class="form-control"
                                   value="Rp 0"
                                   readonly>
                        </div>

                        <!-- Diskon jika diperlukan -->
                        <div class="mb-3">
                            <label class="form-label">
                                Diskon (%)
                            </label>

                            <input type="number"
                                   id="diskon"
                                   name="diskon"
                                   class="form-control"
                                   value="0"
                                   min="0"
                                   max="100"
                                   step="0.01"
                                   required>
                        </div>

                        <!-- Total pembayaran -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Total Pembayaran
                            </label>

                            <input type="text"
                                   id="total"
                                   class="form-control fw-bold"
                                   value="Rp 0"
                                   readonly>
                        </div>

                        <!-- Bayar -->
                        <div class="mb-3">
                            <label class="form-label">
                                Uang Pembayaran
                            </label>

                            <input type="number"
                                   id="bayar"
                                   name="bayar"
                                   class="form-control"
                                   placeholder="Masukkan jumlah uang"
                                   min="0"
                                   step="0.01"
                                   required>
                        </div>

                        <!-- Kembalian -->
                        <div class="mb-3">
                            <label class="form-label">
                                Kembalian
                            </label>

                            <input type="text"
                                   id="kembalian"
                                   class="form-control text-success fw-bold"
                                   value="Rp 0"
                                   readonly>
                        </div>

                        <button type="submit"
                                id="btnSimpan"
                                class="btn btn-success w-100">
                            Simpan Transaksi
                        </button>

                    </div>
                </div>

            </div>

        </div>

    </form>

</div>

<!-- JAVASCRIPT -->
<script>
// Pilih data dari database
const produk = @json($buku);

// array keranjang
let keranjang = [];

function rupiah(angka) {
    return 'Rp ' + Number(angka).toLocaleString('id-ID');
}

// mencegah karakter XSS
function escapeHTML(text) {
    return String(text).replace(/[&<>"']/g, function(m) {
        return {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        }[m];
    });
}

// mencari produk
document.getElementById('cariProduk')
.addEventListener('input', function() {
    let keyword = this.value.toLowerCase().trim();

    let hasilPencarian =
        document.getElementById('hasilPencarian');

    hasilPencarian.innerHTML = '';

    if (keyword === '') {
        hasilPencarian.innerHTML = `
            <p class="text-muted text-center">
                Ketik nama produk untuk mencari.
            </p>
        `;

        return;
    }

    // filter produk by nama
    let hasil = produk.filter(item => {
        return item.nama_buku
            .toLowerCase()
            .includes(keyword);
    });

    if (hasil.length === 0) {
        hasilPencarian.innerHTML = `
            <div class="alert alert-warning">
                Produk tidak ditemukan
            </div>
        `;

        return;
    }

    // tampil hasil pencarian
    hasil.forEach(item => {
        let div = document.createElement('div');
        div.className = 'card mb-2';

        div.innerHTML = `
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">
                            ${escapeHTML(item.nama_buku)}
                        </h6>

                        <div>
                            Harga:
                            <strong>${rupiah(item.harga)}</strong>
                        </div>

                        <small class="text-muted">
                            Stok tersedia: ${item.stock}
                        </small>
                    </div>

                    <button type="button"
                            class="btn btn-primary btn-sm">
                        + Tambah
                    </button>
                </div>
            </div>
        `;

        div.querySelector('button')
            .addEventListener('click', function() {
                tambahProduk(item.id);
            });

        hasilPencarian.appendChild(div);
    });
});

// tambah produk
function tambahProduk(id) {
    let item = produk.find(p => p.id == id);
    let ada = keranjang.find(p => p.id == id);

    if (ada) {
        // CEK STOK
        if (ada.qty >= Number(item.stock)) {
            alert('Stok tidak mencukupi');
            return;
        }

        ada.qty++;
    } else {
        keranjang.push({
            id: item.id,
            nama: item.nama_buku,
            harga: Number(item.harga),
            qty: 1,
            stok: Number(item.stock)
        });
    }

    tampilkanKeranjang();
    hitungTotal();
}

// tampilkan keranjang
function tampilkanKeranjang() {
    let html = '';

    keranjang.forEach((item, index) => {
        let jumlah = item.harga * item.qty;

        html += `
            <tr>
                <td>${index + 1}</td>

                <td>
                    ${escapeHTML(item.nama)}
                </td>

                <td>
                    ${rupiah(item.harga)}
                </td>

                <td>
                    <input type="number"
                           class="form-control"
                           style="width:80px"
                           min="1"
                           max="${item.stok}"
                           value="${item.qty}"
                           onchange="ubahQty(${item.id}, this.value)">
                </td>

                <td>
                    ${rupiah(jumlah)}
                </td>

                <td>
                    <button type="button"
                            class="btn btn-danger btn-sm"
                            onclick="hapusProduk(${item.id})">
                        Hapus
                    </button>
                </td>
            </tr>
        `;
    });

    if (keranjang.length === 0) {
        html = `
            <tr>
                <td colspan="6"
                    class="text-center text-muted">
                    Keranjang masih kosong
                </td>
            </tr>
        `;
    }

    document.getElementById('keranjang').innerHTML = html;
}

// adjust jumlah quantity produk
function ubahQty(id, qty) {
    let item = keranjang.find(p => p.id == id);
    qty = Number(qty);

    if (!Number.isInteger(qty) || qty < 1) {
        tampilkanKeranjang();
        return;
    }

    if (qty > item.stok) {
        alert('Stok tidak mencukupi');
        tampilkanKeranjang();
        return;
    }

    item.qty = qty;

    tampilkanKeranjang();
    hitungTotal();
}

// hapus produk
function hapusProduk(id) {
    keranjang = keranjang.filter(p => p.id != id);

    tampilkanKeranjang();
    hitungTotal();
}

// hitung total bayar
function hitungTotal() {
    let subtotal = 0;

    // hitung subtotal
    keranjang.forEach(item => {
        subtotal += item.harga * item.qty;
    });

    // ambil diskon
    let persen = Number(
        document.getElementById('diskon').value
    );

    // validasi diskon untuk tampilan
    if (!Number.isFinite(persen)) {
        persen = 0;
    }

    persen = Math.min(100, Math.max(0, persen));

    // hitung potongan diskon
    let potongan = subtotal * persen / 100;

    // hitung total
    let total = subtotal - potongan;

    // get uang bayar
    let bayar = Number(
        document.getElementById('bayar').value
    ) || 0;

    // hitung kembalian
    let kembalian = Math.max(0, bayar - total);

    // tampilkan hasil
    document.getElementById('subtotal').value =
        rupiah(subtotal);

    document.getElementById('total').value =
        rupiah(total);

    document.getElementById('kembalian').value =
        rupiah(kembalian);
}

// event diskon dan bayar
document.getElementById('diskon')
    .addEventListener('input', hitungTotal);

document.getElementById('bayar')
    .addEventListener('input', hitungTotal);

// simpan transaksi
document.getElementById('formKasir')
.addEventListener('submit', function(e) {
    // cek keranjang
    if (keranjang.length === 0) {
        e.preventDefault();
        alert('Keranjang masih kosong');
        return;
    }

    let subtotal = 0;
    keranjang.forEach(item => {
        subtotal += item.harga * item.qty;
    });

    let diskon = Number(
        document.getElementById('diskon').value
    );

    let bayar = Number(
        document.getElementById('bayar').value
    );

    // validasi diskon
    if (!Number.isFinite(diskon) ||
        diskon < 0 || diskon > 100) {
        e.preventDefault();
        alert('Diskon harus antara 0 sampai 100%');
        return;
    }

    // hitung total
    let total = subtotal - (subtotal * diskon / 100);

    // validasi pembayaran
    if (!Number.isFinite(bayar) || bayar < total) {
        e.preventDefault();
        alert('Pembayaran belum mencukupi');
        return;
    }

    // kirim data keranjang ke Laravel
    keranjang.forEach((item, index) => {
        // id buku
        let inputId = document.createElement('input');
        inputId.type = 'hidden';
        inputId.name = `items[${index}][buku_id]`;
        inputId.value = item.id;

        // jumlah buku
        let inputQty = document.createElement('input');
        inputQty.type = 'hidden';
        inputQty.name = `items[${index}][qty]`;
        inputQty.value = item.qty;

        this.appendChild(inputId);
        this.appendChild(inputQty);
    });
});
</script>
@endsection
