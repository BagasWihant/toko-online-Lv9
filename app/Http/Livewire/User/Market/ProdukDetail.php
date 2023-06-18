<?php

namespace App\Http\Livewire\User\Market;

use App\Models\Keranjang;
use App\Models\ProdukWarna;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ProdukDetail extends Component
{
    use LivewireAlert;
    public $produk, $kategori, $warnaId = null;
    public $pilihanWarna = 0, $jumlahWarnaIni;
    public $qty = 1;
    public function render()
    {
        return view('livewire.user.market.produk-detail', ['kategori' => $this->kategori, 'produk' => $this->produk]);
    }

    public function pilihWarna($id)
    {
        $warna = ProdukWarna::where('id', $id)->first();
        $this->jumlahWarnaIni = $warna->qty;
        $this->warnaId = $id;
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

    public function masukKeranjang($id)
    {
        if (Auth::check()) {
            if ($this->warnaId != null) {
                // dd(Keranjang::where('user_id', Auth::id())->where('produk_id', $id)->where('produk_warna_id', $this->warnaId)->toSql());

                if (!Keranjang::where('user_id', Auth::id())->where('produk_id', $id)->where('produk_warna_id', $this->warnaId)->exists()) {
                    Keranjang::create([
                        'user_id' => Auth::id(),
                        'produk_id' => $id,
                        'produk_warna_id' => $this->warnaId,
                        'quantity' => $this->qty
                    ]);
                    $this->emit('masukKeranjang');

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
            }else{
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
}
