<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ProdukWarna;
use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    use HasFactory;
    protected $table = 'gambar_produk';
    protected $fillable = [
        'produk_id','gambar'
    ];
}
