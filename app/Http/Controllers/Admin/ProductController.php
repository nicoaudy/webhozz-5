<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'code' => 'required|numeric',
            'name' => 'required',
            'kategori' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        $extention = request('photo')->getClientOriginalExtension();
        $imageName = time().'.'. $extention;
        $path = public_path('/images');
        request('photo')->move($path, $imageName);

        // Upload file
        Product::create([
            'code' => request('code'),
            'name' => request('name'),
            'category' => request('kategori'),
            'photo' => 'images/' . $imageName
        ]);

        return redirect()->to('/admin/product');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('admin.product.edit', [
            'product' => $product
        ]);
    }

    public function update($id)
    {
        $this->validate(request(), [
            'code' => 'required|numeric',
            'name' => 'required',
            'category' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg'
        ]);

        $product = Product::where('id', $id)->first();

        if (request()->hasFile('photo')) {
            // Delete file yang lama
            unlink(public_path($product->photo));

            // Upload file yang baru
            $extention = request('photo')->getClientOriginalExtension();
            $imageName = time().'.'. $extention;
            $path = public_path('/images');
            request('photo')->move($path, $imageName);
        }

        $product->update([
            'code' => request('code'),
            'name' => request('name'),
            'category' => request('category'),
            'photo' => $path ? 'images/' . $imageName : $product->photo
        ]);

        return redirect()->to('/admin/product');
    }

    public function destroy($id)
    {
        // Product::find($id);
        $product = Product::where('id', $id)->first();

        // Delete photo
        unlink(public_path($product->photo));

        $product->delete();

        return redirect()->to('/admin/product');
    }
}
