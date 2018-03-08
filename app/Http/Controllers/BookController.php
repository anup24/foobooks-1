<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        return view('books.index');
    }

    public function show($title) {
        return view('books.show')->with(['title' => $title]);
    }
}
