<?php

namespace Tests\Feature\Services\Handlers;

use App\Services\Generators\RandomHashGenerator;
use App\Services\Handlers\DecreaseUrlClicksCountHandler;
use App\Services\Infrastructure\RedisUrlRepository;
use Mockery\MockInterface;
use Tests\Generators\UrlEntityGenerator;
use Tests\TestCase;

class DecreaseUrlClicksCountHandlerTest extends TestCase
{
    private function getDecreaseUrlClicksCountHandler(): DecreaseUrlClicksCountHandler
    {
        return app(DecreaseUrlClicksCountHandler::class);
    }

    private function getRandomHashGenerator(): RandomHashGenerator
    {
        return app(RandomHashGenerator::class);
    }

    /**
     * @group Handlers
     */
    public function testHandleWillNotChangeClicksCount(): void
    {
        $hash = $this->getRandomHashGenerator()->generate();
        $urlEntity = UrlEntityGenerator::buildAndGenerate([
            'clicksCount' => 0,
        ]);
        $this->mock(RedisUrlRepository::class, function (MockInterface $mock) {
            $mock->expects('update')
                ->never();
        });
        $this->getDecreaseUrlClicksCountHandler()->handle($urlEntity, $hash);
    }

    /**
     * @group Handlers
     */
    public function testHandleWillChangeClicksCount(): void
    {
        $hash = $this->getRandomHashGenerator()->generate();
        $urlEntity = UrlEntityGenerator::buildAndGenerate();
        $this->mock(RedisUrlRepository::class, function (MockInterface $mock) {
            $mock->expects('update')
                ->once();
        });
        $this->getDecreaseUrlClicksCountHandler()->handle($urlEntity, $hash);
    }

    /**
     * @group Handlers
     */
    public function testHandleWillDeleteUrl(): void
    {
        $hash = $this->getRandomHashGenerator()->generate();
        $urlEntity = UrlEntityGenerator::buildAndGenerate([
            'clicksCount' => 1,
        ]);
        $this->mock(RedisUrlRepository::class, function (MockInterface $mock) {
            $mock->expects('delete')
                ->once();
        });
        $this->getDecreaseUrlClicksCountHandler()->handle($urlEntity, $hash);
    }
}
