<?php

namespace App\Http\Controllers;

use App\Cart;
use Exception;
use Midtrans\Config;
use Midtrans\Snap;
use App\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmationMail;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function store()
    {
        $carts = Cart::where('paid', false)->get();
        $amount = $carts->reduce(function ($item, $cart) {
            return $cart->product->price + $item;
        });

        $items = $carts->map(function ($c) {
            return [
                'id' => $c->id,
                'code' => $c->product->code,
                'name' => $c->product->name,
                'price' => $c->product->price,
                'quantity' => 1,
            ];
        });

        // Populate customer's billing address
        $billing_address = array(
            'first_name'   => "Andri",
            'last_name'    => "Setiawan",
            'address'      => "Karet Belakang 15A, Setiabudi.",
            'city'         => "Jakarta",
            'postal_code'  => "51161",
            'phone'        => "081322311801",
            'country_code' => 'IDN'
        );

        // Populate customer's shipping address
        $shipping_address = array(
            'first_name'   => "John",
            'last_name'    => "Watson",
            'address'      => "Bakerstreet 221B.",
            'city'         => "Jakarta",
            'postal_code'  => "51162",
            'phone'        => "081322311801",
            'country_code' => 'IDN'
        );

        // Populate customer's info
        $customer_details = array(
            'first_name'       => "Andri",
            'last_name'        => "Setiawan",
            'email'            => "test@test.com",
            'phone'            => "081322311801",
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );

        $orderNumber = rand();
        $transaction_details = array(
            'order_id' => $orderNumber,
            'gross_amount' => $amount,
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'        => $items->toArray(),
            'customer_details'    => $customer_details
        );

        try {
            $paymentUrl = Snap::createTransaction($transaction_data)->redirect_url;

            // UPDATE STATUS TRANSAKSI
            Transaction::create([
                'order_id' => $orderNumber,
                'total' => $amount,
                'status' => 'waiting for payment'
            ]);

            // Kirim email ke customer
            Mail::to('acephidayat127@gmail.com')->send(new PaymentConfirmationMail($carts, $orderNumber));

            // Mail::send('viewnya', function($mail){
            //     $mail->to('foo@bar.com');
            // });

            header('Location: ' . $paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
