<?php

namespace Tests\Feature\Services\Infrastructure;

use App\Services\Generators\RandomHashGenerator;
use App\Services\Infrastructure\RedisUrlRepository;
use App\Services\DTO\UrlEntity;
use Tests\Generators\UrlEntityGenerator;
use Tests\TestCase;

class RedisUrlRepositoryTest extends TestCase
{
    private function getRedisUrlRepository(): RedisUrlRepository
    {
        return app(RedisUrlRepository::class);
    }

    private function getRandomHashGenerator(): RandomHashGenerator
    {
        return app(RandomHashGenerator::class);
    }

    /**
     * @group Infrastructure
     * @group Redis
     */
    public function testStoreStoresUrlEntity(): void
    {
        $urlEntity = UrlEntityGenerator::buildAndGenerate();
        $hash = $this->getRandomHashGenerator()->generate();
        $this->getRedisUrlRepository()->store($urlEntity, $hash);

        $this->assertTrue($this->getRedisUrlRepository()->exists($hash));
    }

    /**
     * @group Infrastructure
     * @group Redis
     */
    public function testGetUrlEntityReturnsStored(): void
    {
        $urlEntity = UrlEntityGenerator::buildAndGenerate();
        $hash = $this->getRandomHashGenerator()->generate();
        $this->getRedisUrlRepository()->store($urlEntity, $hash);

        $retrievedEntity = $this->getRedisUrlRepository()->get($hash);
        $this->assertInstanceOf(UrlEntity::class, $retrievedEntity);
        $this->assertEquals($urlEntity->getUrl(), $retrievedEntity->getUrl());
        $this->assertEquals($urlEntity->getClicksCount(), $retrievedEntity->getClicksCount());
        $this->assertEquals($urlEntity->getLifetime(), $retrievedEntity->getLifetime());
    }

    /**
     * @group Infrastructure
     * @group Redis
     */
    public function testGetUrlEntityReturnsNull(): void
    {
        $retrievedEntity = $this->getRedisUrlRepository()->get($this->getRandomHashGenerator()->generate());
        $this->assertNull($retrievedEntity);
    }

        /**
     * @group Infrastructure
     * @group Redis
     */
    public function testExistsReturnsTrue(): void
    {
        $urlEntity = UrlEntityGenerator::buildAndGenerate();
        $hash = $this->getRandomHashGenerator()->generate();
        $this->getRedisUrlRepository()->store($urlEntity, $hash);

        $this->assertTrue($this->getRedisUrlRepository()->exists($hash));
    }

    /**
     * @group Infrastructure
     * @group Redis
     */
    public function testExistsReturnsFalse(): void
    {
        $this->assertFalse($this->getRedisUrlRepository()->exists($this->getRandomHashGenerator()->generate()));
    }
}
