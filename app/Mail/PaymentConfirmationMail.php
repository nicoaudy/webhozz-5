<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $carts;
    public $orderNumber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($carts, $orderNumber)
    {
        $this->carts = $carts;
        $this->orderNumber = $orderNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.payment_confirmation', [
            'carts' => $this->carts,
            'orderNumber' => $this->orderNumber
        ]);
    }
}
