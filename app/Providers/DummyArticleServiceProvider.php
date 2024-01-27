<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class DummyArticleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // おすすめの記事を取得
        View::composer(
            'components_pseudo.recommend_articles',
            'App\Http\Composers\RecommendedArticleComposer'
        );

        // 新着記事を取得
        View::composer(
            'components_pseudo.new_articles',
            'App\Http\Composers\NewArticleComposer'
        );
    }
}
