<?php

namespace Tests\Feature\Http;

use App\Http\Routes\WebRoutes;
use App\Services\Generators\RandomHashGenerator;
use App\Services\Repositories\UrlRepository;
use Tests\Generators\UrlEntityGenerator;
use Tests\TestCase;

class ShowUrlControllerTest extends TestCase
{
    private function getUrlRepository(): UrlRepository
    {
        return app(UrlRepository::class);
    }

    private function getRandomHashGenerator(): RandomHashGenerator
    {
        return app(RandomHashGenerator::class);
    }

    /**
     * @group http
     */
    public function testShowRedirectsToOriginUrl(): void
    {
        $hash = $this->getRandomHashGenerator()->generate();
        $entity = UrlEntityGenerator::buildAndGenerate();
        $this->getUrlRepository()->store($entity, $hash);
        $this->get(WebRoutes::showUrl($hash))
            ->assertRedirect($entity->getUrl());
    }

    /**
     * @group http
     */
    public function testShowRedirectsTo404(): void
    {
        $hash = $this->getRandomHashGenerator()->generate();
        $this->get(WebRoutes::showUrl($hash))->assertNotFound();
    }
}
