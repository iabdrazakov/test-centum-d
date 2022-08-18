<?php

namespace Tests\Feature\Services\Handlers;

use App\Services\Generators\RandomHashGenerator;
use App\Services\Handlers\UrlStoreHandler;
use App\Services\Infrastructure\RedisUrlRepository;
use Mockery\MockInterface;
use Tests\Generators\UrlEntityGenerator;
use Tests\TestCase;

class UrlStoreHandlerTest extends TestCase
{
    private function getUrlStoreHandler(): UrlStoreHandler
    {
        return app(UrlStoreHandler::class);
    }

    private function getRedisUrlRepository(): RedisUrlRepository
    {
        return app(RedisUrlRepository::class);
    }

    /**
     * @group Handlers
     */
    public function testHandleReturnsStoresUrlEntityToRedis(): void
    {
        $urlEntity = UrlEntityGenerator::buildAndGenerate();
        $hash = $this->getUrlStoreHandler()->handle($urlEntity);
        $this->assertTrue($this->getRedisUrlRepository()->exists($hash));
        $this->assertIsString($hash);
    }

    /**
     * @group Handlers
     */
    public function testHandleCallsGeneratorOnce(): void
    {
        $urlEntity = UrlEntityGenerator::buildAndGenerate();
        $this->mock(RandomHashGenerator::class, function (MockInterface $mock) {
            $mock->expects('generate')
                ->andReturn($this->faker->word)
                ->once();
            });
        $this->getUrlStoreHandler()->handle($urlEntity);
    }
}
