<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trivium;

class TriviaController extends Controller
{
    // ランディングページを表示
    public function index()
    {
        return view('trivia.index');
    }
}
