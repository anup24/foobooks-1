<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return App::environment(); # <- This is what we're testing out
        #return 'Here are all the books...';
    }

    public function show($title)
    {
        return 'You are viewing the book ' . $title;
    }
}
