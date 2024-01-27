<?php

namespace App\Http\Composers;

use Illuminate\View\View;

use App\Models\DummyArticle;

class NewArticleComposer
{
    public function compose(View $view)
    {
        $newArticles = [];
        // 現在の全項目数を取得
        $maxNum = DummyArticle::all()->count();
        // 表示数を最大10個に設定
        $showNum = min($maxNum, 10);
        $newArticles = DummyArticle::orderBy('id', 'desc')->take($showNum)->get();
        $view->with('new_articles', $newArticles);
    }
}
