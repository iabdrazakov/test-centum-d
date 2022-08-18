<?php

namespace App\Services\Infrastructure;

use Illuminate\Support\Facades\Redis;
use Redis as RedisClient;
use RedisCluster;

class RedisRepository
{
    private RedisCluster|RedisClient $redis;

    public function __construct()
    {
        $this->redis = Redis::connection()->client();
    }

    public function getByKey(string $key): ?array
    {
        $data = $this->redis->get($key);
        if (! $data) {
            return null;
        }
        if (! is_string($data)) {
            return null;
        }

        $data = json_decode($data, true);
        if (! $data) {
            return [];
        }

        return $data;
    }

    public function setByKey(string $key, array $data, int $ttl): void
    {
        if ($ttl < 1) {
            return;
        }
        $this->redis->set($key, json_encode($data), $ttl);
    }

    public function deleteByKey(string $key): void
    {
        $this->redis->del($key);
    }

    public function hasKey(string $key): bool
    {
        return (bool) $this->redis->exists($key);
    }
}
