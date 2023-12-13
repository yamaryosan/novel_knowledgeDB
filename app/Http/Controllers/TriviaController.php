<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TriviaController extends Controller
{
    // ランディングページを表示
    public function index()
    {
        return view('trivia.index');
    }
}
