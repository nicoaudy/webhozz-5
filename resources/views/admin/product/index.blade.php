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
            <th>Price</th>
            <th>Category</th>
            <th>Photo</th>
            <th colspan="2">Action</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
			<td style="text-align: right;">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
            <td>{{ $product->category }}</td>
            <td>
				<img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" style="width: 100px; height: 100px">
			</td>
            <td>
                <a href="/admin/product/{{ $product->id }}/edit" class="btn btn-info">Edit</a>
            </td>
			<td>
				<form action="/admin/product/{{ $product->id }}" method="POST">
					@method('DELETE')
					@csrf
					<button type="submit" class="btn btn-danger">Delete</button>
				</form>
			</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection