<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class RecommendArticleServiceProvider extends ServiceProvider
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
    }
}
