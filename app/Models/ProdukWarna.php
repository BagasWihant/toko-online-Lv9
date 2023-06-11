<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukWarna extends Model
{
    use HasFactory;
    protected $table = 'produk_warna';
    protected $fillable = ['warna','qty','produk_id'];

}
