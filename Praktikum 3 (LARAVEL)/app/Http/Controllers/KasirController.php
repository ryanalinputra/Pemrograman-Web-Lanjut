<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class KasirController extends Controller
{
    public function index()
    {
        $buku = Buku::where('stock', '>', 0)->get();

        return view('kasir.index', compact('buku'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.buku_id' => 'required|exists:buku,id',
            'items.*.qty' => 'required|integer|min:1',
            'diskon' => 'required|numeric|min:0|max:100',
            'bayar' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $subtotal = 0;
            $daftarBuku = [];

            foreach ($request->items as $item) {
                $buku = Buku::where('id', $item['buku_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $qty = $item['qty'];

                // Cek stok
                if ((int) $buku->stock < $qty) {
                    throw ValidationException::withMessages([
                        'items' => 'Stok buku ' . $buku->nama_buku . ' tidak mencukupi.'
                    ]);
                }

                $jumlah = (float) $buku->harga * $qty;
                $subtotal += $jumlah;

                $daftarBuku[] = [
                    'buku' => $buku,
                    'qty' => $qty,
                    'subtotal' => $jumlah
                ];
            }

            // Hitung diskon
            $diskon = $subtotal * $request->diskon / 100;

            // Hitung total
            $total = $subtotal - $diskon;

            // Validasi pembayaran
            if ($request->bayar < $total) {
                throw ValidationException::withMessages([
                    'bayar' => 'Uang pembayaran kurang.'
                ]);
            }

            // Simpan transaksi utama
            $penjualan = Penjualan::create([
                'tanggal' => now(),
                'subtotal' => $subtotal,
                'diskon' => $diskon,
                'total' => $total,
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $total
            ]);

            // Simpan detail dan kurangi stok
            foreach ($daftarBuku as $item) {
                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'buku_id' => $item['buku']->id,
                    'harga' => $item['buku']->harga,
                    'qty' => $item['qty'],
                    'subtotal' => $item['subtotal']
                ]);

                $item['buku']->decrement('stock', $item['qty']);
            }
        });

        return redirect('/kasir')
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    // Untuk riwayat transaksi
    public function riwayat()
    {
        $penjualan = Penjualan::latest()->get();

        return view('penjualan.index', compact('penjualan'));
    }

    // Untuk detail transaksi
    public function detail($id)
    {
        $penjualan = Penjualan::with('detail.buku')
            ->findOrFail($id);

        return view('penjualan.detail', compact('penjualan'));
    }
}
