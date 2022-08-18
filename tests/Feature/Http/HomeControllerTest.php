<?php

namespace Tests\Feature\Http;

use App\Http\Routes\WebRoutes;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * @group http
     */
    public function testRendersHomeView(): void
    {
        $response = $this->get(WebRoutes::home())->assertOk();
        $response->assertViewIs('home');
    }
}
