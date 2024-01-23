<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\SearchService;

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

    // 検索フォームの処理
    public function post(Request $request)
    {
        // バリデーション
        $request->validate([
            'keyword' => 'required|max:255',
        ]);

        // 検索キーワードを取得
        $keyword = $request->input('keyword');

        // 検索結果ページにリダイレクト
        return redirect()->route('workspace_result');
        }

    // 検索結果ページ
    public function result(Request $request)
    {
        // キーワードを取得
        $keyword = $request->input('keyword');
        $target = "title";

        // キーワードを含む項目を取得
        $searchService = new SearchService($keyword, $target);
        $trivia = $searchService->search();
        if ($trivia[0]->title === '検索結果がありません') {
            return redirect()->route('index');
        }

        // 検索キーワードをビューに渡す
        return view('workspace_mode.result', [
            'keyword' => $keyword,
            'target' => $target,
            'trivia' => $trivia,
            'previousPageUrl' => route('home'),
        ]);
    }
}
