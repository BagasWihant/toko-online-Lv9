<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{
    use WithPagination;

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
            if ($keranjang->exists()) {
                return view('user.checkout');
            }
            return redirect(route('keranjang'));
        } else {
            return redirect('/login');
        }
    }

    public function payment($payToken, $trx)
    {
        if (Auth::check()) {
            $order = Order::where('transaksi_id', $trx);
            if ($order->exists()) {
                if ($payToken) {
                    $update = $order->first();
                    $update->payToken = $payToken;
                    $update->update();
                    return view('user.payment', [
                        'token' => $payToken
                    ]);
                }
                return redirect(route('home'));
            }
            return redirect(route('keranjang'));
        } else {
            return redirect('/login');
        }
    }
    public function terima_barang(Request $id)
    {
        $order = Order::find($id)->first();
        $order->status_order = 0;
        $order->save();
        return redirect()->back();
    }

    public function orders_history()
    {
        if (Auth::check()) {
            $history = Order::where('user_id', Auth::id())
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
            return view('user.history.order_history', compact('history'));
        } else {
            return redirect('/login');
        }
    }

    public function user_settings()
    {
        if (Auth::check()) {
            return view('user.user-settings');
        } else {
            return redirect('/login')->with('pesan', 'Silahkan login dulu untuk mengakses');
        }
    }
}
