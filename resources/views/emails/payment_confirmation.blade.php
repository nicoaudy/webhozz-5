@component('mail::message')
# Menunggu Pembayaran

Order kamu diterima dengan id {{ $orderNumber }}. Berikut detail barang yang kamu pesan:
<ul>
    @foreach($carts as $cart)
        <li>{{ $cart->product->code }} - {{ $cart->product->name }} | {{ $cart->product->price }}</li>
    @endforeach
</ul>

@component('mail::button', ['url' => 'http://webhozz.test'])
    Periksa Pembayaran
@endcomponent

Terima Kasih,<br>
Kibif 🌭
@endcomponent
