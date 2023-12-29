<?php

namespace App\Http\Composers;

use Illuminate\View\View;

use App\Models\Trivium;

class RandomTriviumComposer
{
    public function compose(View $view)
    {
        $randomTrivia = [];
        for ($i = 0; $i < 10; $i++) {
            $randomTrivia[] = Trivium::inRandomOrder()->first();
        }
        $view->with('randomTrivia', $randomTrivia);
    }
}
