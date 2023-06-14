<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index(){
        $slider = Slider::where('status',1)->get();
        return view('user.index',compact('slider'));
    }
    public function semuaKategori() {
        $kategori = Category::where('status',1)->get();
        return view('user.kategori.allkategori',compact('kategori'));
    }

    public function produk($kategori_slug) {
        $kategori = Category::where('slug',$kategori_slug)->first();
        if($kategori){
            $produk = $kategori->product()->get();
            // dd($produk);
            return view('user.kategori.listproduk',compact('produk','kategori'));
        }else{
            return redirect()->back();
        }
    }
}
