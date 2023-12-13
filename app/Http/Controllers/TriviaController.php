<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trivium;

class TriviaController extends Controller
{
    // ランディングページを表示
    public function index()
    {
        // データが取り出せるか確認してみる
        $trivia = Trivium::all();
        dd($trivia);
    }
}
