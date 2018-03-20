@extends('layouts.master')

@push('head')
    <link href='/css/trivia.css' rel='stylesheet'>
@endpush

@section('title')
    Trivia
@endsection

@section('content')

    @if($correct)
        <h1 class='correct'>You got it! <i class='fa fa-smile-o'></i></h1>
    @else
        <h1 class='incorrect'>Sorry, that was incorrect. <i class='fa fa-frown-o'></i></h1>
    @endif

    <p>The correct answer was <em>{{ $answer }}</em></p>

    <a href='/trivia'>Play again?</a>

@endsection
