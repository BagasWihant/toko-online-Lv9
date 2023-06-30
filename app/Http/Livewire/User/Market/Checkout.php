<?php

namespace App\Http\Livewire\User\Market;

use App\Models\Order;
use Livewire\Component;
use App\Models\Keranjang;
use App\Models\OrderDetail;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $newKeranjang, $snapToken;
    public function hitungTotal()
    {
        $keranjang = Keranjang::where('user_id', Auth::id())->get();
        $totalSemua = $qty = 0;
        foreach ($keranjang as $k) {
            $totalSemua += $k->quantity * $k->produk->harga_jual;
            $qty += $k->quantity;
        }
        $this->newKeranjang['total'] = $totalSemua;
        $this->newKeranjang['qty'] = $qty;

        return $this->newKeranjang;
    }

    public function buat_pesanan()
    {
        // CEK ALAMAT ADA TIDAK
        $user = UserDetail::where('user_id', Auth::id());
        if ($user->exists()) {
            $user = $user->first();
        } else {
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
            'qty' => $this->newKeranjang['qty'],
            'total_harga' => $this->newKeranjang['total'],
            'status' => 'Unpaid',
        ]);


        $keranjang = Keranjang::where('user_id', Auth::id());
        foreach($keranjang->get() as $orderDetail){
            OrderDetail::create([
                'order_id' => $order->id,
                'produk_id' => $orderDetail->produk_id,
                'qty' => $orderDetail->quantity,
                'produk_warna_id' => $orderDetail->produk_warna_id,
            ]);
        }
        $keranjang->delete();


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
                'gross_amount' => $this->newKeranjang['total'],
            ),
            'customer_details' => array(
                'first_name' => $user->nama_lengkap,
                'email' => $user->user->email,
                'phone' => $user->no_telp,
            ),
        );

        $this->snapToken = \Midtrans\Snap::getSnapToken($params);
        //  $this->dispatchBrowserEvent('midtrans__token');
        return redirect(route('payment', [
            'token' => $this->snapToken,
            'trx' => $transaksi_id
        ]));
    }

    public function render()
    {
        $this->hitungTotal();
        $dataUser = UserDetail::where('user_id', Auth::id())->first();
        return view('livewire.user.market.checkout', [
            'keranjang' => $this->newKeranjang,
            'data' => $dataUser
        ]);
    }
}
