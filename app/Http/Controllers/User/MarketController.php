<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Keranjang;
use App\Models\Order;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
    public function index()
    {
        $slider = Slider::where('status', 1)->get();
        $kategori = Category::where('status', 1)->get();
        return view('user.index', compact('slider', 'kategori'));
    }
    public function semuaKategori()
    {
        $kategori = Category::where('status', 1)->get();
        return view('user.kategori.allkategori', compact('kategori'));
    }

    public function produk($kategori_slug)
    {
        $kategori = Category::where('slug', $kategori_slug)->first();
        if ($kategori) {
            $produk = $kategori->product()->get();
            // dd($produk);
            return view('user.kategori.listproduk', compact('produk', 'kategori'));
        } else {
            return redirect()->back();
        }
    }
    public function produkDetail($kategori_slug, $produk_slug)
    {
        $kategori = Category::where('slug', $kategori_slug)->first();
        if ($kategori) {
            $produk = $kategori->product()->where('kategori_id', $kategori->id)->where('slug', $produk_slug)->first();
            return view('user.produk.produkdetail', compact('produk', 'kategori'));
        } else {
            return redirect()->back();
        }
    }

    public function keranjang()
    {
        if (Auth::check()) {
            return view('user.keranjang');
        } else {
            return redirect('/login');
        }
    }

    public function wishlist()
    {
        return view('user.wishlist');
    }

    public function checkout()
    {
        if (Auth::check()) {
            $keranjang = Keranjang::where('user_id', Auth::id());
            if($keranjang->exists()){
                return view('user.checkout');
            }
            return redirect(route('keranjang'));
        } else {
            return redirect('/login');
        }
    }

    public function payment(Request $req){
        if (Auth::check()) {

            $order = Order::where('transaksi_id', $req->trx);
            if($order->exists()){

                if($req->token){
                    return view('user.payment',[
                        'token' => $req->token
                    ]);
                }
                return redirect(route('home'));
            }
            return redirect(route('keranjang'));
        } else {
            return redirect('/login');
        }
    }

    public function user_settings()
    {
        if (Auth::check()) {
            return view('user.user-settings');
        } else {
            return redirect('/login');
        }
    }


    // API CALLBACK
    public function callback_mid(Request $req)
    {

        $server_key = config('midtrans.server_key');
        $hashed = hash('sha512', $req->order_id . $req->status_code . $req->gross_amount . $server_key);
        if ($hashed == $req->signature_key) {
            $transaction = $req->transaction_status;
            $type = $req->payment_type;
            $order_id = $req->order_id;
            $order = Order::where('transaksi_id', $req->order_id)->first();
            if (($transaction == 'capture') || ($transaction == 'settlement')) {
                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                $order->update([
                    'status' => 'Paid',
                    'tipe_pembayaran' => $type
                ]);
                return 'Success Updated';
            } else {
                $order->update([
                    'status' => $transaction,
                    'tipe_pembayaran' => $type
                ]);
                // TODO set payment status in merchant's database to 'Denied'
                return "Payment using " . $type . " status $transaction";
            }
            Keranjang::where('user_id', Auth::id())->delete();
        } else {
            return 'Transaksi tidak ditemukan';
        }
    }
}
