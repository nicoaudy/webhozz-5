@extends('layouts.app')

@section('title')
	Kibif | Belanja
@endsection

@section('content')
<div class="album py-5 bg-light">
	<div class="container">
		<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
			@foreach($products as $item)
			<div class="col">
				<div class="card shadow-sm">
					<img src="{{ asset($item->photo) }}" alt="{{ $item->name }}" style="height: 300px; width: 100%;" class="bd-placeholder-img card-img-top" />

					<div class="card-body">
						<p class="card-text">{{ $item->code }} - {{ $item->name }}</p>
						<div class="d-flex justify-content-between align-items-center">
							<small class="text-muted">Rp. {{ number_format($item->price, 0, ',', '.') }}</small>
							<form action="/add-to-card" method="POST">
								@csrf
								<input type="hidden" value="{{ $item->id }}" name="product_id"/>
								<button type="submit" class="btn btn-sm btn-outline-secondary">Add to cart</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection
