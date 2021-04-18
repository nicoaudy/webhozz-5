@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add Product</h1>
    <form>
        <div class="mb-3">
            <label class="form-label">Code</label>
            <input type="text" name="code" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control">
        </div>
         <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control">
        </div>
         <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection