<?php

namespace App\Http\Livewire\User\Market\Produk;

use Livewire\Component;

class ProdukKategori extends Component
{
    public $produk,$kategori;
    public function mount($produk,$kategori)
    {
        $this->produk=$produk;
        $this->kategori=$kategori;
    }
    public function render()
    {
        return view('livewire.user.market.produk.produk-kategori',['produk'=>$this->produk,'kategori'=>$this->kategori]);
    }
}
