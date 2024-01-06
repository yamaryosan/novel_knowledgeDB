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

    // 編集用フォーム
    public function edit($id)
    {
        $tempTrivium = TempTrivium::findOrFail($id);
        return view('temp.edit', compact('tempTrivium'));
    }

    // 編集内容の保存
    public function update(Request $request, $id)
    {
        $tempTrivium = TempTrivium::findOrFail($id);
        $tempTrivium->title = $request->title ?? '';
        $tempTrivium->summary = $request->summary ?? '';
        $tempTrivium->detail = $request->detail ?? '';
        $tempTrivium->save();
        return redirect()->route('temp');
    }

    // 削除
    public function delete($id)
    {
        $tempTrivium = TempTrivium::findOrFail($id);
        $msg = "{$tempTrivium->title}を削除完了";
        $tempTrivium->delete();
        return redirect()->route('temp')->with('flash_succeed_message', $msg);
    }
}
