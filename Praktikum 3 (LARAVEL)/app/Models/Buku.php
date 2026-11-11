<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama_buku', 'harga', 'stock'];
}
