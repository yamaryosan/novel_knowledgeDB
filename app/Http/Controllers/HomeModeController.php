<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trivium;

class HomeModeController extends Controller
{
    public function index()
    {
        return view('home_mode.index');
    }

    // ランディングページでの検索フォームの処理
    public function post(Request $request)
    {
        // バリデーション
        $request->validate([
            'keyword' => 'required|max:255',
        ]);

        // 検索キーワードを取得
        $keyword = $request->input('keyword');

        // 検索結果ページにリダイレクト
        return redirect()->route('home.result');
    }

    // 検索結果ページ
    public function result(Request $request)
    {
        // キーワードを取得
        $keyword = $request->input('keyword');

        // キーワードを含む項目を取得
        $trivia = Trivium::where('title', 'like', '%'.$keyword.'%')->get();

        dd($trivia);

        // 検索キーワードをビューに渡す
        return view('home_mode.result', [
            'keyword' => $keyword,
            'trivia' => $trivia,
        ]);
    }

    // 新規作成ページ
    public function create()
    {
        return view('home_mode.create');
    }

    // 新規作成
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'summary' => 'required|max:255',
            'detail' => 'required|max:255',
        ]);

        // モデルを使って、DBに保存する値をセット
        $trivium = new Trivium;
        $trivium->title = $request->title;
        $trivium->summary = $request->summary;
        $trivium->detail = $request->detail;

        // DBに保存
        $trivium->save();

        // トップページにリダイレクト
        return redirect()->route('home');
    }
}
