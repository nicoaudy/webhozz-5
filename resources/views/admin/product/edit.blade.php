@extends('layouts.app')

@section('content')
<div class="container mt-4">
    @foreach ($errors->all() as $error)
        <div class="alert alert-alt alert-danger alert-dismissible" role="alert">
            <p class="alert-link">{{ $error }}</p>
        </div>
    @endforeach

    <h1 class="mb-4">Edit Product</h1>
	<form action="/admin/product/{{ $product->id }}" method="POST" enctype="multipart/form-data">
		@method('PUT')
		@csrf
        <div class="mb-3">
            <label class="form-label">Code</label>
			<input type="text" name="code" class="form-control" value="{{ $product->code }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Product Name</label>
			<input type="text" name="name" class="form-control" value="{{ $product->name }}">
        </div>
         <div class="mb-3">
            <label class="form-label">Category</label>
			<input type="text" name="category" class="form-control" value="{{ $product->category }}">
        </div>
		<img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" style="width: 100px; height: 100px">
         <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection