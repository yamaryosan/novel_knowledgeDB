<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trivium;

use App\Services\FileService;
use App\Services\SearchService;

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

        if (empty($keyword)) {
            return redirect()->route('home')->with('flash_error_message', 'キーワードは必須です');
        }
        if (mb_strlen($keyword) > env('MAX_SEARCH_KEYWORD_LENGTH')) {
            return redirect()->route('home')->with('flash_error_message', '30文字以内で入力してください');
        }

        // 検索ターゲットを取得
        $target = $request->input('target');

        // キーワードを含む項目を取得
        $searchService = new SearchService($keyword, $target);
        $trivia = $searchService->search();
        if ($trivia[0]->title === '検索結果がありません') {
            return redirect()->route('home')->with('flash_error_message', '検索結果がありません');
        }

        // 検索キーワードをビューに渡す
        return view('home_mode.result', [
            'keyword' => $keyword,
            'target' => $target,
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

    // インポート
    public function import(Request $request)
    {
        $files = $request->file('files');
        // ファイルが選択されていなければエラーを表示
        if (empty($files)) {
            return redirect()->route('home')->with('flash_error_message', 'ファイルを選択してください');
        }
        $fileService = new FileService('import');
        // テキストファイル以外はエラーを表示
        if (!$fileService->upload($files)) {
            return redirect()->route('home')->with('flash_error_message', '.txtファイルを選択してください');
        }
        // 項目の取得
        $trivia = $fileService->read();

        // 項目をDBに保存
        foreach ($trivia as $item) {
            $trivium = new Trivium;
            $trivium->title = $item['title'];
            $trivium->summary = $item['summary'];
            $trivium->detail = $item['detail'];
            $trivium->save();
        }

        return redirect()->route('home')->with('flash_succeed_message', 'インポート完了!');
    }
}
