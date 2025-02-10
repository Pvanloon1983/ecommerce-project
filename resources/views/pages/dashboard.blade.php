<x-layout pageTitle="Dashboard">
	<div class="container">
		
		<h1>Dashboard</h1>		

		<h2>Welcome {{ auth()->check() ? auth()->user()->first_name : 'Gast' }}</h2>

	</div>
</x-layout>