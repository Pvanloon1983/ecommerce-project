<x-layout pageTitle="Dashboard">
	<div class="container">

		@if (session('status'))
		<div class="alert alert-success">
				<p>{{ session('status') }}</p>
		</div>
		@endif
		
		<h1>Dashboard</h1>		

		<h2>Welcome {{ auth()->check() ? auth()->user()->first_name : 'Gast' }}</h2>

		<table id="products">
			<tr>
				<th>ID</th>
				<th>Titel</th>
				<th>Prijs</th>
				<th>Afbeelding</th>
			</tr>

			@foreach ($products as $product)
			<tr>
				<td>{{ $product->id }}</td>
				<td>{{ $product->title }}</td>
				<td>{{ $product->price }}</td>
				<td><img src="{{ $product->picture_one }}" alt=""></td>
			</tr>		
			@endforeach

		</table>
		<div class="pagination-container">
			{{ $products->links('vendor.pagination.default') }}
	</div>	
	</div>
</x-layout>