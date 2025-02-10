<x-layout page="password-forget">
	<div class="container">
		<div class="form-container">
			<h1>Wachtwoord resetten</h1>
			<form class="form" action="{{ route('password.email') }}" method="POST">
				@csrf
				@if (session('status'))
						<div class="alert alert-success">
								<p>{{ session('status') }}</p>
						</div>
				@endif
				<div class="form-control">
					<label for="email">E-mail</label>
					<input name="email" id="email" type="email" value="{{ old('email') }}">
					@error('email')
						<p class="form_error">{{ $message }}</p>
					@enderror
				</div>
				<div class="form-control">
					<button class="btn" type="submit">Verzenden</button>
				</div>				
			</form>
		</div>
	</div>
</x-layout>