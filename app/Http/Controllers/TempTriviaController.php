<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TempTrivium;

class TempTriviaController extends Controller
{
    public function index()
    {
        $tempTrivia = TempTrivium::all();
        $previousPageUrl = route('home');
        return view('temp.index', compact('tempTrivia', 'previousPageUrl'));
    }

    public function edit($id)
    {
        $tempTrivium = TempTrivium::findOrFail($id);
        return view('temp.edit', compact('tempTrivium'));
    }
}
