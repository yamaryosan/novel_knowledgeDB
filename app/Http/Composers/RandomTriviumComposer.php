<?php

namespace App\Http\Composers;

use Illuminate\View\View;

use App\Models\Trivium;

class RandomTriviumComposer
{
    public function compose(View $view)
    {
        $randomTrivium = Trivium::inRandomOrder()->first();
        $view->with('randomTrivium', $randomTrivium);
    }
}
