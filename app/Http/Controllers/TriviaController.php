<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TriviaController extends Controller
{
    public function index()
    {
        return 'Show the question and the form where the user can enter their answer';
    }

    public function checkAnswer()
    {
        return 'Check the answer and then redirect the user back to the index page';
    }
}
