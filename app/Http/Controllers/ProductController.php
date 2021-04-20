<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        noty()->flash('Hai!', 'Selamat Berbelanja');

        $products = Product::all();
        return view('product.index', [
            'products' => $products
        ]);
    }
}
