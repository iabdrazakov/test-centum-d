<?php

namespace Tests\Feature\Services\Resolvers;

use App\Services\DTO\UrlEntity;
use App\Services\Generators\RandomHashGenerator;
use App\Services\Infrastructure\RedisUrlRepository;
use App\Services\Resolvers\UrlByHashResolver;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Tests\Generators\UrlEntityGenerator;
use Tests\TestCase;

class UrlByHashResolverTest extends TestCase
{
    private function getUrlByHashResolver(): UrlByHashResolver
    {
        return app(UrlByHashResolver::class);
    }

    private function getRedisUrlRepository(): RedisUrlRepository
    {
        return app(RedisUrlRepository::class);
    }

    private function getRandomHashGenerator(): RandomHashGenerator
    {
        return app(RandomHashGenerator::class);
    }

    /**
     * @group Resolvers
     */
    public function testResolveReturnsUrlEntity(): void
    {
        $hash = $this->getRandomHashGenerator()->generate();
        $entity = UrlEntityGenerator::buildAndGenerate();
        $this->getRedisUrlRepository()->store($entity, $hash);
        $retrievedEntity = $this->getUrlByHashResolver()->resolve($hash);
        $this->assertInstanceOf(UrlEntity::class, $retrievedEntity);
        $this->assertEquals($entity->getUrl(), $retrievedEntity->getUrl());
        $this->assertEquals($entity->getClicksCount(), $retrievedEntity->getClicksCount());
        $this->assertEquals($entity->getLifetime(), $retrievedEntity->getLifetime());
    }

    /**
     * @group Resolvers
     */
    public function testResolveThrowsNotFoundException(): void
    {
        $hash = $this->getRandomHashGenerator()->generate();
        $this->expectException(NotFoundResourceException::class);
        $this->getUrlByHashResolver()->resolve($hash);
    }
}
