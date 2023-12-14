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
}
