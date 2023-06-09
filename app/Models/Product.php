<?php

namespace App\Models;

use App\Models\GambarProduk;
use App\Models\ProdukWarna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name','brand','slug','deskripsi','harga_jual','jumlah','trending','status'];

        public function productImage()
        {
            return $this->hasMany(GambarProduk::class,'produk_id','id');
        }
        public function productWarna()
        {
            return $this->hasMany(ProdukWarna::class,'produk_id','id');
        }
        function category() {
            return $this->belongsTo(Category::class,'kategori_id','id');
        }
}
