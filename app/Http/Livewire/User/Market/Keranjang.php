<?php

namespace App\Http\Livewire\User\Market;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Keranjang as ModelsKeranjang;
use App\Models\Order;
use App\Models\UserDetail;
use Jantinnerezo\LivewireAlert\LivewireAlert;


class Keranjang extends Component
{
    public $data = [], $snapToken;
    use LivewireAlert;


    public function plusQty($id)
    {
        $keranjang = ModelsKeranjang::where('id', $id)->where('user_id', Auth::id())->first();
        $produk = Product::where('id', $keranjang->produk_id)->first();
        if ($keranjang->quantity > $produk->jumlah) {
            return false;
        }

        $keranjang->increment('quantity');
        $keranjang->update();
    }
    public function minQty($id)
    {

        $keranjang = ModelsKeranjang::where('id', $id)->where('user_id', Auth::id())->first();
        $produk = Product::where('id', $keranjang->produk_id)->first();
        if ($keranjang->quantity <= 1) {
            return false;
        }

        $keranjang->decrement('quantity');
        $keranjang->update();
    }

    public function hapus($id)
    {
        $keranjang = ModelsKeranjang::where('id', $id)->where('user_id', Auth::id())->first();
        $keranjang->delete();
        $this->emit('masukKeranjang');
    }

    public function checkout()
    {
        // CEK ALAMAT ADA TIDAK
        $user = UserDetail::where('user_id', Auth::id());
        if(!$user->exists()){
            $this->alert('warning', 'Perhatian!!!', [
                'text' => 'Mohon Isi Alamat di dulu yaa..',
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
            return false;
        }

        return redirect()->route('checkout');
    }


    public function render()
    {
        $this->data = ModelsKeranjang::where('user_id', Auth::id())->get();

        return view('livewire.user.market.keranjang', ['data' => $this->data]);
    }
}
