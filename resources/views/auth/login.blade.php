<x-layout page="register">
	<div class="container">
		<div class="register-form-container">
			<h1>Inloggen</h1>
			<form class="register-form" action="{{ route('login') }}" method="POST">
				@csrf
				<div class="form-control">
					<label for="email">E-mail</label>
					<input name="email" id="email" type="email" value="{{ old('email') }}">
					@error('email')
						<p class="form_error">{{ $message }}</p>
					@enderror
				</div>
				<div class="form-control">
					<label for="password">Wachtwoord</label>
					<input name="password" id="password" type="password">
					@error('password')
						<p class="form_error">{{ $message }}</p>
					@enderror
				</div>
				<div class="form-control">
					<button class="btn" type="submit">Inloggen</button>
				</div>
			</form>
		</div>
	</div>
</x-layout>