<?php
/**
 * Description of RedisCacheRepositoryTest.php.
 *
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Yehor Herasymchuk <yehor@dotsplatform.com>
 */

namespace Tests\Feature\Services\Infrastructure;

use App\Services\Generators\RandomHashGenerator;
use App\Services\Infrastructure\RedisRepository;
use Tests\TestCase;

class RedisCacheRepositoryTest extends TestCase
{
    private function getRedisRepository(): RedisRepository
    {
        return app(RedisRepository::class);
    }

    private function getRandomHashGenerator(): RandomHashGenerator
    {
        return app(RandomHashGenerator::class);
    }

    /**
     * @group Infrastructure
     * @group Redis
     */
    public function testGetByKeyReturnsEmptyArray(): void
    {
        $key = $this->getRandomHashGenerator()->generate();
        $cachedData = $this->getRedisRepository()->getByKey($key);

        $this->assertNull($cachedData);
    }

    /**
     * @group Infrastructure
     * @group Redis
     */
    public function testSetAndGetByKeyReturnsData(): void
    {
        $key = $this->getRandomHashGenerator()->generate();
        $data = [
            $this->getRandomHashGenerator()->generate(),
            $this->getRandomHashGenerator()->generate(),
            $this->getRandomHashGenerator()->generate(),
            $this->getRandomHashGenerator()->generate(),
        ];
        $this->getRedisRepository()->setByKey($key, $data, 10);
        $cachedData = $this->getRedisRepository()->getByKey($key);

        $this->assertNotEmpty($cachedData);
        $this->assertEquals($data, $cachedData);
    }

    /**
     * @group Infrastructure
     * @group Redis
     */
    public function testSetOn0DoNotSet(): void
    {
        $key = $this->getRandomHashGenerator()->generate();
        $data = [
            $this->getRandomHashGenerator()->generate(),
        ];
        $this->getRedisRepository()->setByKey($key, $data, 0);
        $cachedData = $this->getRedisRepository()->getByKey($key);

        $this->assertNull($cachedData);
    }

    /**
     * @group Infrastructure
     * @group Redis
     */
    public function testDeleteIfEmpty(): void
    {
        $key = $this->getRandomHashGenerator()->generate();
        $this->getRedisRepository()->deleteByKey($key);
        $this->assertTrue(true);
    }

    /**
     * @group Infrastructure
     * @group Redis
     */
    public function testDelete(): void
    {
        $key = $this->getRandomHashGenerator()->generate();
        $data = [
            $this->getRandomHashGenerator()->generate(),
        ];
        $this->getRedisRepository()->setByKey($key, $data, 10);
        $this->getRedisRepository()->deleteByKey($key);

        $cachedData = $this->getRedisRepository()->getByKey($key);

        $this->assertEmpty($cachedData);
    }
}
