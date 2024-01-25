<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\SearchService;
use App\Services\MergeService;

use App\Models\Trivium;
use App\Models\DummyArticle;

class WorkspaceModeController extends Controller
{
    // ランディングページを表示
    public function index()
    {
        // セッションに職場閲覧モードアクセス用フラグがなければ、トップページにリダイレクト
        if (!session('access_granted')) {
            return redirect()->route('top');
        }
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

        // ダミー記事を10件取得
        $dummy_articles = DummyArticle::orderBy('id', 'desc')->take(10)->get();

        // 検索キーワードをビューに渡す
        return view('workspace_mode.result', [
            'keyword' => $keyword,
            'target' => $target,
            'trivia' => $trivia,
            'dummy_articles' => $dummy_articles,
            'previousPageUrl' => route('home'),
        ]);
    }

    // 記事詳細ページ
    public function show($id)
    {
        // 記事を取得
        $trivium = Trivium::findOrFail($id);

        // 記事詳細ページを表示
        return view('workspace_mode.show', [
            'trivium' => $trivium,
            'previousPageUrl' => route('workspace_result'),
        ]);
    }

    // ダミー記事詳細ページ
    public function dummy_show($id)
    {
        // ダミー記事を取得
        $dummy_article = DummyArticle::findOrFail($id);

        // ダミー記事詳細ページを表示
        return view('workspace_mode.dummy_show', [
            'trivium' => $dummy_article,
            'previousPageUrl' => route('workspace_result'),
        ]);
    }
}
