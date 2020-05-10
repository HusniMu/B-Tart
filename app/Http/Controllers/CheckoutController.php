<?php

namespace App\Http\Controllers;

use Cart;
use App\Post;
use Carbon\Carbon;
use Veritrans_Snap;
use App\CustomOrder;
use App\Transaction;
use Veritrans_Config;
use App\TransactionDetail;
use Veritrans_Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:2',
            'email' => 'required|email',
            'alamat_lengkap' => 'required',
            'zip' => 'required|numeric',
            'no_hp' => 'required|numeric',
            'post_id' => 'required',
            'custom_order_id' => 'required',
            'order_id' => 'required',
            'jumlah' => 'required',
            'transaction_total' => 'required',
        ]);

        $transaction = Transaction::create([
            'post_id' => json_encode($request->post_id),
            'custom_order_id' => json_encode($request->custom_order_id),
            'user_id' => Auth::user()->id,
            'transaction_total' => $request->transaction_total,
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat_lengkap' => $request->alamat_lengkap,
            'zip' => $request->zip,
            'no_hp' => $request->no_hp,
            'transaction_status' => 'PENDING',
        ]);

        $transaction->save();

        $transaction_detail = TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'order_id' => json_encode($request->order_id),
            'jumlah' => json_encode($request->jumlah),
            'pengiriman' => 'PENDING'
        ]);

        $transaction_detail->save();

        Cart::instance('produk')->destroy();
        Cart::instance('cusPro')->destroy();
        // return var_dump($transaction_detail);

        Toastr::success('Transaction Success', 'Success');
        return redirect(route('home'));
    }

    public function index()
    {
        $produk = Cart::instance('produk')->content();
        return view('checkout',compact('produk'));
    }

    public function success(Request $request)
    {
        # code...
    }

}
