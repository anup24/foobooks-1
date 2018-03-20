<nav>
    <ul>
        {{-- $nav is defined and made available to views via app/Http/Controllers/Controller.php --}}
        @foreach($nav as $link => $label)
            <li><a href='/{{ $link }}' class='{{ Request::is($link) ? 'active' : '' }}'>{{ $label }}</a>
        @endforeach
    </ul>
</nav>
