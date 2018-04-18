@extends('layouts.master')

@section('title')
    Edit  {{$book->title}}
@endsection

@section('content')

    <h1>Edit</h1>
    <h2>{{$book->title}}</h2>

    <form method='POST' action='/books/{{ $book->id }}'>
        {{ method_field('put') }}
        {{ csrf_field() }}

        <div class='details'>* Required fields</div>

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title' value='{{ old('title', $book->title) }}'>
        @include('modules.error-field', ['field' => 'title'])

        <label for='title'>* Author</label>
        <input type='text' name='author' id='author' value='{{ old('author', $book->author) }}'>
        @include('modules.error-field', ['field' => 'author'])

        <label for='published_year'>* Published Year (YYYY)</label>
        <input type='text' maxlength='4' name='published_year' id='published_year' value='{{ old('published_year', $book->published_year) }}'>
        @include('modules.error-field', ['field' => 'published_year'])

        <label for='cover_url'>* Cover URL </label>
        <input type='text' name='cover_url' id='cover_url' placeholder='http://' value='{{ old('cover_url', $book->cover_url) }}'>
        @include('modules.error-field', ['field' => 'cover_url'])

        <label for='purchase_url'>* Purchase URL </label>
        <input type='text' name='purchase_url' id='purchase_url' placeholder='http://' value='{{ old('purchase_url', $book->purchase_url) }}'>
        @include('modules.error-field', ['field' => 'purchase_url'])

        <input type='submit' value='Save changes' class='btn btn-primary'>
    </form>

    @include('modules.error-form')



@endsection