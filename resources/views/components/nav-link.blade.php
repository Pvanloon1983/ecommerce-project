@props(['active' => false, 'link' => '/'])

<li class="menu-item"><a style="{{ $active ? 'color:#fff' : '' }}" href="{{ $link }}">{{ $slot }}</a></li>