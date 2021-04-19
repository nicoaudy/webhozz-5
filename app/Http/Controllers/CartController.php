<?php

namespace App\Http\Controllers;

use App\Cart;

class CartController extends Controller
{
    public function store()
    {
        Cart::create([
            'product_id' => request('product_id')
        ]);

        return back();
    }
}
