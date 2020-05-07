<?php

namespace App\Http\Controllers;

use Veritrans_Snap;
use Veritrans_Config;
use Cart;
use App\Model\transaction;
use Veritrans_Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $produk = Cart::instance('produk')->content();
        return view('checkout',compact('produk'));
    }

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

        // Set midtrans configuration
        Veritrans_Config::$serverKey = config('services.midtrans.serverKey');
        Veritrans_Config::$isProduction = config('services.midtrans.isProduction');
        Veritrans_Config::$isSanitized = config('services.midtrans.isSanitized');
        Veritrans_Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function store()
    {
        \DB::transaction(function () {
            // Save donasi ke database
            $transaksi = transaction::create([
                'donor_name' => $this->request->donor_name,
                'donor_email' => $this->request->donor_email,
                'donation_type' => $this->request->donation_type,
                'amount' => floatval($this->request->amount),
                'note' => $this->request->note,
            ]);

            // Buat transaksi ke midtrans kemudian save snap tokennya.
            $payload = [
                'transaction_details' => [
                    'order_id'      => $donation->id,
                    'gross_amount'  => $donation->amount,
                ],
                'customer_details' => [
                    'first_name'    => $donation->donor_name,
                    'email'         => $donation->donor_email,
                    // 'phone'         => '08888888888',
                    // 'address'       => '',
                ],
                'item_details' => [
                    [
                        'id'       => $donation->donation_type,
                        'price'    => $donation->amount,
                        'quantity' => 1,
                        'name'     => ucwords(str_replace('_', ' ', $donation->donation_type))
                    ]
                ]
            ];
            $snapToken = Veritrans_Snap::getSnapToken($payload);
            $donation->snap_token = $snapToken;
            $donation->save();

            // Beri response snap token
            $this->response['snap_token'] = $snapToken;
        });
    }

}
