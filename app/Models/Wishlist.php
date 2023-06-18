<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table ="table_wishlist";
    protected $fillable = [
        "user_id",
        "produk_id",
    ];


    function produk() {
        return $this->belongsTo(Product::class,'produk_id','id');
    }
}
