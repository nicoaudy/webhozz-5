@extends('layouts.app')

@section('title')
    List All Products
@endsection

@section('content')
<div class="container mt-4">
    <h1>Admin Product</h1>
    <a href="/admin/product/create" class="btn btn-primary mb-4">Add Product</a>
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>#</th>
            <th>Code</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category }}</td>
            <td></td>
            <td>
                <a href="/admin/product/{{ $product->id }}/edit" class="btn btn-info">Edit</a>
                <a href="" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection