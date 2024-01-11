<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TempTrivium;
use App\Models\Trivium;

class TempTriviaController extends Controller
{
    public function index()
    {
        $tempTrivia = TempTrivium::all();
        $previousPageUrl = route('home');
        return view('temp.index', compact('tempTrivia', 'previousPageUrl'));
    }

    // 新規作成処理
    public function store(Request $request)
    {
        // 遷移元が新規作成ページか編集ページか判定
        $mode = '';
        $id = $request->query('id');
        if (is_null($id) === true) {
            $mode = 'create';
        } else {
            $mode = 'edit';
            // 編集ページの場合は既存のデータを削除
            $trivium = Trivium::findOrFail($id);
            $trivium->delete();
        }
        $tempTrivium = new TempTrivium();
        $tempTrivium->title = $request->title ?? '';
        $tempTrivium->summary = $request->summary ?? '';
        $tempTrivium->detail = $request->detail ?? '';
        $msg = "「{$tempTrivium->title}」を保存完了";
        $tempTrivium->save();
        return redirect()->route('home')->with('flash_succeed_message', $msg);
    }

    // 編集用フォーム
    public function edit($id)
    {
        // プレビューからの入力値を取得
        $title = old('title');
        $summary = old('summary');
        $detail = old('detail');

        $tempTrivium = TempTrivium::findOrFail($id);
        return view('temp.edit', compact('tempTrivium', 'title', 'summary', 'detail'));
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

    // プレビュー
    public function preview(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required',
            'detail' => 'required',
        ]);
        $trivium = new TempTrivium();
        $id = $request->id;
        $title = $request->title ?? '';
        $summary = $request->summary ?? '';
        $detail = $request->detail ?? '';
        return view('temp.preview', compact('id', 'title', 'summary', 'detail'));
    }

    // プレビューから戻る
    public function back(Request $request)
    {
        $id = $request->id;
        return redirect()->route('temp_edit', ['id' => $id])->withInput();
    }

    // 一時保存項目を正式に保存
    public function migrate(Request $request)
    {
        // 一時保存項目を削除
        $id = $request->id;
        $tempTrivium = TempTrivium::findOrFail($request->id);
        $tempTrivium->delete();

        // 正式に保存
        $trivium = new Trivium();
        $trivium->title = $request->title;
        $trivium->summary = $request->summary;
        $trivium->detail = $request->detail;
        $trivium->save();
        $msg = "「{$trivium->title}」を作成完了";
        return redirect()->route('home')->with('flash_succeed_message', $msg);
    }
}
