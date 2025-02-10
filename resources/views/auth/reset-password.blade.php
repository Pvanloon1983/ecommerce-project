<x-layout page="password-forget">
	<div class="container">
		<div class="form-container">
			<h1>Wachtwoord herstellen</h1>
			<form class="form" action="{{ route('password.update') }}" method="POST">
				@csrf
				<div class="form-control">
					<label for="email">E-mail</label>
					<input name="email" id="email" type="email" value="{{ old('email') ?? request('email') }}">
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
				<input hidden name="token" type="text" value="{{ $token ?? '' }}">
				<div class="form-control">
					<button class="btn" type="submit">Verzenden</button>
				</div>				
			</form>
		</div>
	</div>
</x-layout>