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

    public function checkout($totalHarga, $qty)
    {
        // CEK ALAMAT ADA TIDAK
        $user = UserDetail::where('user_id', Auth::id());
        if($user->exists()){
            $user = $user->first();
        }else{
            $this->alert('warning', 'Perhatian!!!', [
                'text' => 'Mohon Isi Alamat dan Nomor telepon dulu yaa..',
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'timerProgressBar' => true,
            ]);
            return false;
        }

        $_id = 'TRX-' . Auth::id() . strtotime(date('Y-m-d H:i:s'));
        $transaksi_id = str_pad($_id, 17, '0');
        $order = Order::create([
            'transaksi_id' => $transaksi_id,
            'user_id' => Auth::id(),
            'address' => $user->fulltext_alamat,
            'qty' => $qty,
            'total_harga' => $totalHarga,
            'status' => 'Unpaid',
        ]);


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaksi_id,
                'gross_amount' => $totalHarga,
            ),
            'customer_details' => array(
                'first_name' => $user->nama_lengkap,
                'email' => $user->user->email,
                'phone' => $user->no_telp,
            ),
        );

        $this->snapToken = \Midtrans\Snap::getSnapToken($params);
        // return $this->snapToken;
        $this->dispatchBrowserEvent('midtrans__token');
    }


    public function render()
    {
        $this->data = ModelsKeranjang::where('user_id', Auth::id())->get();

        return view('livewire.user.market.keranjang', ['data' => $this->data]);
    }
}
