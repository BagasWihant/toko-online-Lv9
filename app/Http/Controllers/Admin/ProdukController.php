<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $data = array('title' => 'Produk');
        return view('admin.produk.mainProduk', $data);
    }

    public function edit($id)
    {
        $data = array('title' => 'Produk','id' => $id);
        return view('admin.produk.editProduk', $data);
    }

}
