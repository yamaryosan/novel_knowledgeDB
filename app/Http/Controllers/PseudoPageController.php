<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PseudoPageController extends Controller
{
    // 職場閲覧モードランディングページ
    public function index()
    {
        return view('pseudo_page.index');
    }
}
