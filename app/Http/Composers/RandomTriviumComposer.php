<?php

namespace App\Http\Composers;

use Illuminate\View\View;

use App\Models\Trivium;

class RandomTriviumComposer
{
    public function compose(View $view)
    {
        $randomTrivia = [];
        // 現在の全項目数を取得
        $maxNum = Trivium::all()->count();
        // 表示数を最大10個に設定
        $showNum = min($maxNum, 10);
        for ($i = 0; $i < $showNum; $i++) {
            $randomTrivia[] = Trivium::inRandomOrder()->first();
        }
        $view->with('randomTrivia', $randomTrivia);
    }
}
