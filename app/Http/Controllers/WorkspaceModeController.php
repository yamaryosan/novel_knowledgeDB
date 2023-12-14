<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkspaceModeController extends Controller
{
    // ランディングページを表示
    public function index()
    {
        return view('workspace_mode.index');
    }

    // セッション確認用(デバッグ)
    public function session(Request $request)
    {
        $history = $request->session()->get('navigation_history') ?: [];
        return $history;
    }

}
