<?php

namespace App\Models;

use App\Models\GambarProduk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name','brand','slug','deskripsi','harga_asli','harga_jual','jumlah','trending','status',
        'meta_title','meta_deskripsi','meta_keyword'];

        public function productImage()
        {
            return $this->hasMany(GambarProduk::class,'produk_id','id');
        }
}
