<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';

    protected $fillable = [
        'tanggal',
        'subtotal',
        'diskon',
        'total',
        'bayar',
        'kembalian'
    ];

    public function detail()
    {
        return $this->hasMany(
            DetailPenjualan::class,
            'penjualan_id'
        );
    }
}
