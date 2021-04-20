@extends('layouts.app')

@section('title')
    List All Products
@endsection

@section('content')
<div class="container mt-4">
    <h1>Cart</h1>
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Price Each</th>
            <th>Sub total</th>
            <th>Quantity</th>
            <th>Photo</th>
            <th colspan="2">Action</th>
        </tr>
        @foreach($carts as $c)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $c[0]->product->code }} - {{ $c[0]->product->name }}</td>
                <td style="text-align: right;">Rp. {{ number_format($c[0]->product->price, 0, ',', '.') }}</td>
                <td style="text-align: right;">Rp. {{ number_format($c[0]->product->price * count($c), 0, ',', '.') }}</td>
                <td>{{ count($c) }}</td>
                <td>
                    <img src="{{ asset($c[0]->product->photo) }}" alt="{{ $c[0]->product->name }}" style="width: 100px; height: 100px">
                </td>
                <td>
                    <form action="/remove-cart/{{ $c[0]->product_id }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr>
            <td></td>
            <td style="text-align: right; font-weight: bold;">Total:</td>
            <td style="text-align: right; font-weight: bold;">Rp. {{ number_format($sub_total, 0, ',', '.') }}</td>
            <td colspan="4">
                <div class="d-grid gap-2">
                    <a href="/" class="btn btn-primary">Bayar Sekarang</a>
                </div>
            </td>
        </tr>
    </table>
</div>
@endsection
