<?php

namespace App\Http\Composers;

use Illuminate\View\View;

use App\Models\DummyArticle;

class RecommendedArticleComposer
{
    public function compose(View $view)
    {
        $dummyArticles = [];
        // 現在の全項目数を取得
        $maxNum = DummyArticle::all()->count();
        // 表示数を最大10個に設定
        $showNum = min($maxNum, 10);
        for ($i = 0; $i < $showNum; $i++) {
            $dummyArticles[] = DummyArticle::inRandomOrder()->first();
        }
        $view->with('dummy_articles', $dummyArticles);
    }
}
