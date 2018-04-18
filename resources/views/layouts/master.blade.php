<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', 'Foobooks')</title>
    <meta charset='utf-8'>

    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
    <link href='/css/foobooks.css' type='text/css' rel='stylesheet'>

    @stack('head')
</head>
<body>

@if(session('alert'))
    <div class='flashAlert'>{{ session('alert') }}</div>
@endif

<header>
    <a href='/'><img src='/images/foobooks-logo@2x.png' id='logo' alt='Foobooks Logo'></a>
    @include('modules.nav')
</header>

<section id='main'>
    @yield('content')
</section>

<footer>
    <a href='http://github.com/susanBuck/foobooks'><i class='fa fa-github'></i> View on Github</a>
</footer>

{{--<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>--}}

@stack('body')

</body>
</html>