<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentSuccessMail;

class MidtransNotificationHandlerController extends Controller
{
    const STATUS_CAPTURE = 'capture';
    const STATUS_SETTLEMENT = 'settlement';
    const STATUS_PENDING = 'pending';
    const STATUS_DENY = 'deny';
    const STATUS_EXPIRE = 'expire';
    const STATUS_CANCEL = 'cancel';
    const TYPE_CC = 'credit_card';
    const FRAUD_CHALLENGE = 'challenge';

    public function store()
    {
        $status     = request()->transaction_status;
        $type       = request()->payment_type;
        $orderId    = request()->order_id;
        $fraud      = request()->fraud_status;
        $signatureInput = request()->signature;

        $input = $orderId . request()->status_code . request()->gross_amount . env('MIDTRANS_KEY');
        $signature = openssl_digest($input, 'sha512');

        if ($signature == $signatureInput) {
            return response()->json([
                'status_code' => request()->status_code,
                'fraud' => request()->fraud_status
            ]);
        }

        if ($status == self::STATUS_CAPTURE) {
            if ($type == self::TYPE_CC) {
                if ($fraud == self::FRAUD_CHALLENGE) {
                    Log::info("Transaction order_id: " . $orderId . " is challenged by FDS");
                } else {
                    $this->handleSuccessPayment(request()->all());
                }
            }
        }

        if ($status == self::STATUS_SETTLEMENT) {
            $this->handleSuccessPayment(request()->all());
        }

        if ($status == self::STATUS_PENDING) {
            return response()->json([
                'status_code' => request()->status_code,
                'fraud' => request()->fraud_status,
                'transaction_status' => $status
            ], 200);
        }

        if ($status == self::STATUS_DENY) {
            $this->handleUnfinish(request()->all());
        }

        if ($status == self::STATUS_EXPIRE) {
            $this->handleUnfinish(request()->all());
        }

        if ($status == self::STATUS_CANCEL) {
            $this->handleUnfinish(request()->all());
        }

        return response()->json([
            'status_code' => request()->status_code,
            'fraud' => request()->fraud_status,
            'transaction_status' => $status
        ], 200);
    }


    public function handleSuccessPayment($payload)
    {
        $transaction = Transaction::where('order_id', $payload['order_id'])->first();

        $transaction->update([
            'status' => 'settlement'
        ]);

        // HAPUS KERANJANG BELANJA
        $carts = Cart::all();
        $carts->map(function($c){
            $c->delete();
        });

        // Kirim email ke customer
        Mail::to('acephidayat127@gmail.com')->send(new PaymentSuccessMail($payload));

        return response()->json([], 200);
    }

    public function handleFinish()
    {
        return response()->json([], 200);
    }

    public function handleUnfinish()
    {
        return response()->json([], 200);
    }

}
