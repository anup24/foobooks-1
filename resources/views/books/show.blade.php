@extends('layouts.master')

@section('title')
    {{ $title }}
@endsection

@push('head')
    <link href='/css/books/show.css' type='text/css' rel='stylesheet'>
@endpush

@section('content')
    <h1>{{ $title }}</h1>

    <p>
        Details about this book will go here...
    </p>
@endsection

