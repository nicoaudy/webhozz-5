@component('mail::message')
# Pembayaran Berhasil {{ $payload['order_id'] }}

Selamat pembayaran kamu berhasil pada {{ $payload['settlement_time' ]}} dengan id transaksi {{ $payload['transaction_id'] }}.

Detail:
    - Tipe Pembayaran: {{ $payload['payment_type'] }}
    - Total: {{ $payload['gross_amount'] }}

@component('mail::button', ['url' => 'http://webhozz.test'])
Belanja Lagi
@endcomponent

Terima kasih,<br>
Kibif 🌭
@endcomponent
