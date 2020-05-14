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
use Exception;
use Illuminate\Support\Facades\Auth;

use Midtrans\Config;
use Midtrans\Snap;

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
            'order_id' => 'required',
            'jumlah' => 'required',
            'transaction_total' => 'required',
        ]);

        $transaction = Transaction::create([
            'post_id' => json_encode($request->post_id),
            'custom_order_id' => json_encode($request->custom_order_id),
            'users_id' => Auth::user()->id,
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

        // Toastr::success('Transaction Success', 'Success');
        // return redirect(route('home'));

        // set konfigurasi midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // buat array untuk dikir ke midtrans
        $midtrans_params = [
            'transaction_details' => [
                'order_id' => 'MIDTRANS-'.$transaction->id,
                'gross_amount' => (int) $transaction->transaction_total
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],
            'enabled_payments' => ['gopay'],
            'vtweb' => []
        ];

        try{
            // ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

            // redirect ke halaman midtrans
            header('Location: '. $paymentUrl);
        } catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function index()
    {
        $produk = Cart::instance('produk')->content();
        return view('checkout',compact('produk'));
    }

    // public function success(Request $request, $id)
    // {
    //     $transaction = Transaction::with([
    //         'details', 'post', 'custom',
    //     ])

    //     // set konfigurasi midtrans
    //     Config::$serverKey = config('midtrans.serverKey');
    //     Config::$isProduction = config('midtrans.isProduction');
    //     Config::$isSanitized = config('midtrans.isSanitized');
    //     Config::$is3ds = config('midtrans.is3ds');

    //     // buat array untuk dikir ke midtrans
    //     $midtrans_params = [
    //         'transaction_details' => [
    //             'order_id' => 'MIDTRANS-'.$transaction->id,
    //             'gross_amout' => (int) $transaction->transaction_total
    //         ],
    //         'customer_details' => [
    //             'first_name' => $transaction->user->name,
    //             'email' => $transaction->user->email
    //         ],
    //         'enabled_patments' = ['gopay'],
    //         'vtweb' => []
    //     ];

    //     try{
    //         // ambil halaman payment midtrans
    //         $paymentUrl = Snap::createTransaction($midtrans_params)->redirect_url;

    //         // redirect ke halaman midtrans
    //         header('Location: '. $paymentUrl);
    //     } catch(Exception $e){
    //         echo $e->getMessage();
    //     }
    // }

}
