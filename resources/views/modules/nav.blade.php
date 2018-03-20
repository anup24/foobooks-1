<nav>
    <ul>
        @foreach(config('app.nav') as $link => $label)
            <li><a href='{{ $link }}' class='{{ Request::is($link) ? 'active' : '' }}'>{{ $label }}</a>
        @endforeach
    </ul>
</nav>
