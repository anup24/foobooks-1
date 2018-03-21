@extends('layouts.master')

@section('title')
    Foobooks Trivia
@endsection

@section('content')
    <h1>Can you guess this book?</h1>

    <p>{{ $clue }}</p>

    <form method='GET' action='/trivia/result'>

        <input type='hidden' name='answer' value='{{ $answer }}'>

        <div class='form-group'>
            <label for='guess'>Your answer:</label>
            <input type='text' name='guess' id='guess'>
            @include('modules.error-field', ['field' => 'guess'])
        </div>

        <div class='form-group'>
            <input type='submit' class='btn btn-primary btn-small' value='Check your answer...'>
        </div>
    </form>

    <a href='/trivia'>Load a different clue...</a>
@endsection
