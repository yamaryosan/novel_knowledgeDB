<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Http\Controllers\HomeModeController;

class HomeModeControllerTest extends TestCase
{
    public function testIndex()
    {
        $controller = new HomeModeController();
        $response = $controller->index();
        $this->assertEquals('home_mode.index', $response->getName());
    }
}
