<x-layout page="register">
	<div class="container">
		<div class="form-container">
			<h1>Registreren</h1>
			<form class="form" action="{{ route('register') }}" method="POST">
				@csrf
				<div class="form-control">
					<label for="first_name">Voornaam</label>
					<input name="first_name" id="first_name" type="text" value="{{ old('first_name') }}">
					@error('first_name')
						<p class="form_error">{{ $message }}</p>
					@enderror
				</div>
				<div class="form-control">
					<label for="last_name">Achternaam</label>
					<input name="last_name" id="last_name" type="text" value="{{ old('last_name') }}">
					@error('first_name')
						<p class="form_error">{{ $message }}</p>
					@enderror
				</div>
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
					<label for="password_confirmation">Wachtwoord bevestigen</label>
					<input name="password_confirmation" id="password_confirmation" type="password">
					@error('password_confirmation')
						<p class="form_error">{{ $message }}</p>
					@enderror
				</div>
				<div class="form-control form-choice">
					<button class="btn" type="submit">Registreren</button>					
				</div>
				<div class="form-question">Al registreerd? <a href="{{ route('login') }}">Inloggen</a></div>
			</form>			
		</div>
	</div>
</x-layout>