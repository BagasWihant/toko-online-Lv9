<?php

namespace App\Http\Controllers;

use App\Mail\CheckoutMail;
use App\Models\User;
use App\Models\Order;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ApiController extends Controller
{
    // API CALLBACK
    public function index(Request $req)
    {

        $server_key = config('midtrans.server_key');
        $hashed = hash('sha512', $req->order_id . $req->status_code . $req->gross_amount . $server_key);
        if ($hashed == $req->signature_key) {
            $transaction = $req->transaction_status;
            $type = $req->payment_type;
            $order_id = $req->order_id;
            $order = Order::where('transaksi_id', $req->order_id)->first();

            $user = User::find($order->user_id);
            $email = $user->email;

            if (($transaction == 'capture') || ($transaction == 'settlement')) {
                // For credit card transaction, we need to check whether transaction is challenge by FDS or not
                $order->update([
                    'status' => 'Paid',
                    'tipe_pembayaran' => $type
                ]);
                Mail::to($email)->send(new CheckoutMail($order));
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
