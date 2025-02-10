<x-layout page="login">
	<div class="container">
		<div class="form-container">
			<h1>Inloggen</h1>
			<form class="form" action="{{ route('login') }}" method="POST">
				@csrf
				@if (session('status'))
						<div class="alert alert-success">
								<p>{{ session('status') }}</p>
						</div>
				@endif
				@if ($errors->has('reset_token_invalid'))
				<div class="alert alert-danger">
								<p>{{ $errors->first('reset_token_invalid') }}</p>
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
					<label for="password">Wachtwoord</label>
					<input name="password" id="password" type="password">
					@error('password')
						<p class="form_error">{{ $message }}</p>
					@enderror
				</div>
				<div class="form-control">
					<button class="btn" type="submit">Inloggen</button>
				</div>
				<div class="form-question">Nog niet geregistreerd? <a href="{{ route('register') }}">Registreren</a></div>
				<div class="form-question">Wachtwoord vergeten? <a href="{{ route('password.request') }}">Klik hier</a></div>
			</form>
		</div>
	</div>
</x-layout>