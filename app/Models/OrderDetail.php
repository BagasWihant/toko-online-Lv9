<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'produk_id',
        'qty',
        'produk_warna_id'
    ];


    function produk() {
        return $this->belongsTo(Product::class,'produk_id','id');
    }

    function produkWarna() {
        return $this->belongsTo(ProdukWarna::class,'produk_warna_id','id');
    }
}
