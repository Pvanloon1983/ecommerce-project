<x-layout>
	<div class="container">
		<h2>Bevestig je e-mailadres</h2>
		<p>Voordat je verder kunt, moet je je e-mailadres bevestigen. Een bevestigingslink is naar je e-mailadres gestuurd.</p>

		@if (session('resent'))
				<div>
						<p>Een nieuwe verificatielink is naar je e-mailadres gestuurd.</p>
				</div>
		@endif


		<form method="POST" action="{{ route('verification.send') }}">
				@csrf
				<button class="btn" type="submit">Verstuur opnieuw de verificatielink</button>
		</form>
	</div>
</x-layout>