<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TempTrivium;

class TempTriviaController extends Controller
{
    public function index()
    {
        $tempTrivia = TempTrivium::all();
        return view('home_mode.index', compact('tempTrivia'));
    }
}
