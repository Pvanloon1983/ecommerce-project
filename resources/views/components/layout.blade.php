@props(['pageTitle' => '', 'page' => ''])

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ $pageTitle }}</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	@vite(['resources/css/style.css', 'resources/js/script.js'])
</head>
<body class="{{ $page }}">
	<div class="navbar">
		<div class="container">
			<div class="logo">
				<a href="/">Logo</a>
			</div>
			<nav>
				<ul class="desktop-nav">
					<x-nav-link link="/" :active="request()->is('/')">Home</x-nav-link>
					@auth
					<x-nav-link link="/dashboard" :active="request()->is('dashboard')">Dashboard</x-nav-link>
					@endauth 
					@guest
					<x-nav-link link="/inloggen" :active="request()->is('inloggen')">Inloggen</x-nav-link>
					<x-nav-link link="/registreren" :active="request()->is('registreren')">Registreren</x-nav-link>
					@endguest
					@auth
					<form action="/logout" method="POST">
							@csrf
							<button class="btn">Log Out</button>
						</form>
					@endauth  
					<li class="hamburger-item"><i class="fa-solid fa-bars menu-icon"></i></li>
				</ul>
			</nav>
		</div>
	</div>
	{{ $slot }}
</body>
</html>