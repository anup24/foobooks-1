@extends('layouts.master')

@section('title')
    New book
@endsection

@section('content')

    @if(isset($title))
        <div class='alert alert-success'>You added the book {{ $title }}. You can add another below.</div>
    @endif

    <h1>Add a new book</h1>

    <form method='POST' action='/books'>
        {{ csrf_field() }}

        <div class='details'>* Required fields</div>

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title' value='{{ old('title', 'Green Eggs & Ham') }}'>
        @include('modules.error-field', ['field' => 'title'])

        <label for='published_year'>* Published Year (YYYY)</label>
        <input type='text' maxlength='4' name='published_year' id='published_year' value='{{ old('published_year', 1960) }}'>
        @include('modules.error-field', ['field' => 'published_year'])

        <label for='cover_url'>* Cover URL </label>
        <input type='text' name='cover_url' id='cover_url' placeholder='http://' value='{{ old('cover_url', 'https://prodimage.images-bn.com/pimages/9780394800165_p0_v4_s550x406.jpg') }}'>
        @include('modules.error-field', ['field' => 'cover_url'])

        <label for='purchase_url'>* Purchase URL </label>
        <input type='text' name='purchase_url' id='purchase_url' placeholder='http://' value='{{ old('purchase_url', 'https://www.barnesandnoble.com/w/green-eggs-and-ham-dr-seuss/1100170349') }}'>
        @include('modules.error-field', ['field' => 'purchase_url'])

        <input type='submit' value='Add book' class='btn btn-primary'>
    </form>

    @include('modules.error-form')



@endsection