<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TriviaController extends Controller
{
    /**
     * GET /trivia
     */
    public function index()
    {
        $json = file_get_contents(database_path('clues.json'));
        $clues = json_decode($json, true);
        $answer = array_rand($clues);
        $clue = $clues[$answer];

        return view('trivia.index')->with([
            'clue' => $clue,
            'answer' => $answer,
        ]);
    }

    /**
     * GET /trivia/result
     */
    public function result(Request $request)
    {
        $messages = [
            'required' => 'You forgot to fill out an answer!'
        ];

        $this->validate($request, [
            'guess' => 'required'
        ], $messages);

        $guess = $request->input('guess');
        $answer = $request->input('answer');

        $correct = strtolower($guess) == strtolower($answer);

        return view('trivia.result')->with([
            'correct' => $correct,
            'answer' => $answer,
        ]);
    }
}
