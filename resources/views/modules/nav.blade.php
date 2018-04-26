<nav>
    <ul>
        @foreach(config('app.nav'.Auth::check()) as $link => $label)
            <li><a href='{{ $link }}' class='{{ Request::is(substr($link, 1)) ? 'active' : '' }}'>{{ $label }}</a>
        @endforeach

        @if(Auth::check())
            <li>
                <form method='POST' id='logout' action='/logout'>
                    {{ csrf_field() }}
                    <a href='#' onClick='document.getElementById("logout").submit();'>Logout {{ $user->name }}</a>
                </form>
            </li>
        @endif
    </ul>
</nav>
