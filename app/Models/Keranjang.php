<?php

namespace App\Models;

use App\Models\Product;
use App\Models\ProdukWarna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keranjang extends Model
{
    use HasFactory;
    protected $table ="table_keranjang";
    protected $fillable = [
        "user_id",
        "produk_id",
        "produk_warna_id",
        "quantity",
    ];

    function produk() {
        return $this->belongsTo(Product::class,'produk_id','id');
    }
    function warna() {
        return $this->belongsTo(ProdukWarna::class,'produk_warna_id','id');
    }
}
