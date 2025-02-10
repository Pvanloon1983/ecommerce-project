<x-layout pageTitle="Dashboard">
	<div class="container">
		@if (session('status'))
		<div class="alert alert-success">
				<p>{{ session('status') }}</p>
		</div>
		@endif
		
		<h1>Dashboard</h1>		

		<h2>Welcome {{ auth()->check() ? auth()->user()->first_name : 'Gast' }}</h2>

	</div>
</x-layout>