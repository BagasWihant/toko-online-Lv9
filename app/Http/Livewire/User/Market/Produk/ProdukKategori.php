<?php

namespace App\Http\Livewire\User\Market\Produk;

use Livewire\Component;
use App\Models\Wishlist;
use App\Models\Keranjang;
use App\Models\Product;
use App\Models\ProdukWarna;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProdukKategori extends Component
{
    use LivewireAlert;
    public $produk, $kategori, $keranjang = [], $jumlahWarnaIni = 0, $kondisi = null, $produkID;
    public $name, $qty = 1, $warnaid, $productWarna = [];
    public $findMinHarga, $findMaxHarga;

    protected $queryString = [
        'findMinHarga' => ['except' => '', 'as' => 'min'],
         'findMaxHarga' => ['except' => '', 'as' => 'max']];

    public function mount($produk, $kategori)
    {
        $this->produk = $produk;
        $this->kategori = $kategori;
    }
    public function pilihWarna($id)
    {
        $warna = ProdukWarna::where('id', $id)->first();
        $this->jumlahWarnaIni = $warna->qty;
        $this->qty = 1;
        $this->warnaid = $id;
    }

    public function plusQty($jml)
    {
        if ($this->jumlahWarnaIni > 0) {
            if ($this->qty >= $this->jumlahWarnaIni) {
                $this->qty = $this->jumlahWarnaIni;
                return false;
            }
        } else {
            if ($this->qty >= $jml) {

                $this->qty = $jml;
                return false;
            }
        }
        $this->qty++;
    }

    public function minQty()
    {
        if ($this->qty <= 1) {
            $this->qty = 1;
            return false;
        }
        $this->qty--;
    }

    public function clearForm()
    {

        $this->kondisi = '';
        $this->produkID = '';
        $this->keranjang = [];
        $this->name = '';
        $this->productWarna = [];
    }

    public function getData($id)
    {
        $this->kondisi = 'modal';
        $this->keranjang = Product::where('id', $id)->first();
        $this->produkID = $id;
        $this->name = $this->keranjang->name;
        $this->productWarna = ProdukWarna::where('produk_id', $id)->get();
    }

    public function masukWishlist($id)
    {
        if (Auth::check()) {
            if (!Wishlist::where('user_id', Auth::id())->where('produk_id', $id)->exists()) {
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'produk_id' => $id
                ]);
                $this->emit('masukWishlist');

                $this->alert('success', 'Produk telah masuk Wishlist', [
                    'position' => 'center',
                    'timer' => 2000,
                    'toast' => true,
                    'timerProgressBar' => true,
                    'customClass' => [
                        'popup' => 'colored-toast'
                    ]
                ]);
            } else {
                $this->alert('warning', 'Produk sudah ada di Wishlist', [
                    'position' => 'center',
                    'timer' => 2000,
                    'toast' => true,
                    'timerProgressBar' => true,
                    'customClass' => [
                        'popup' => 'colored-toast'
                    ]
                ]);
            }
        } else {
            $this->alert('error', 'Silahkan Login Dahulu untuk membeli', [
                'position' => 'center',
                'timer' => 2000,
                'toast' => true,
                'timerProgressBar' => true,
                'customClass' => [
                    'popup' => 'colored-toast'
                ]
            ]);
        }
    }

    public function masukKeranjang()
    {
        $id = $this->produkID;
        if (Auth::check()) {
            if ($this->warnaid != null) {
                // dd(Keranjang::where('user_id', Auth::id())->where('produk_id', $id)->where('produk_warna_id', $this->warnaid)->toSql());

                if (!Keranjang::where('user_id', Auth::id())->where('produk_id', $id)->where('produk_warna_id', $this->warnaid)->exists()) {
                    if ($this->qty <=  $this->jumlahWarnaIni) {
                        Keranjang::create([
                            'user_id' => Auth::id(),
                            'produk_id' => $id,
                            'produk_warna_id' => $this->warnaid,
                            'quantity' => $this->qty
                        ]);
                        $this->emit('masukKeranjang');
                        $this->dispatchBrowserEvent('modal-hide');

                        $this->alert('success', 'Produk masuk Keranjang', [
                            'position' => 'center',
                            'timer' => 2000,
                            'toast' => true,
                            'timerProgressBar' => true,
                            'customClass' => [
                                'popup' => 'colored-toast'
                            ]
                        ]);
                    } else {
                        $this->alert('error', 'Stok untuk produk jenis ini tinggal ' . $this->jumlahWarnaIni, [
                            'position' => 'center',
                            'timer' => 2000,
                            'toast' => true,
                            'timerProgressBar' => true,
                            'customClass' => [
                                'popup' => 'colored-toast'
                            ]
                        ]);
                    }
                } else {
                    // update qty
                    $this->alert('warning', 'Update jumlah di keranjang', [
                        'position' => 'center',
                        'timer' => 2000,
                        'toast' => true,
                        'timerProgressBar' => true,
                        'customClass' => [
                            'popup' => 'colored-toast'
                        ]
                    ]);
                }
            } else {
                $this->alert('warning', 'Mohon pilih warna/jenis dulu', [
                    'position' => 'center',
                    'timer' => 2000,
                    'toast' => true,
                    'timerProgressBar' => true,
                    'customClass' => [
                        'popup' => 'colored-toast'
                    ]
                ]);
            }
        } else {
            $this->alert('error', 'Silahkan Login Dahulu untuk membeli', [
                'position' => 'center',
                'timer' => 2000,
                'toast' => true,
                'timerProgressBar' => true,
                'customClass' => [
                    'popup' => 'colored-toast'
                ]
            ]);
        }
    }


    public function searching()
    {

        $this->produk = Product::when($this->findMinHarga, function ($q) {
            $q->where('harga_jual', '>=', $this->findMinHarga);
        })->when($this->findMaxHarga, function($q){
                $q->where('harga_jual', '<=', $this->findMaxHarga);

        })
        ->get();
    }


    public function render()
    {
        return view('livewire.user.market.produk.produk-kategori', ['produk' => $this->produk, 'kategori' => $this->kategori]);
    }
}
