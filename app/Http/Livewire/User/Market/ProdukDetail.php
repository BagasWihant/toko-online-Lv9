<?php

namespace App\Http\Livewire\User\Market;

use Livewire\Component;

class ProdukDetail extends Component
{
public $produk,$kategori;
    public function render()
    {
        return view('livewire.user.market.produk-detail',['kategori'=>$this->kategori,'produk'=>$this->produk]);
    }
}
