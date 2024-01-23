<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class RandomTriviumProvider extends ServiceProvider
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
        // 自宅閲覧モードのランダム表示
        View::composer(
            'components.random',
            'App\Http\Composers\RandomTriviumComposer'
        );

        // 職場閲覧モードのランダム表示
        View::composer(
            'components_workspace.random',
            'App\Http\Composers\RandomTriviumComposer'
        );
    }
}
