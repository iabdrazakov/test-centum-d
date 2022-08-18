<?php

namespace App\Services\Infrastructure;

use App\Services\Repositories\UrlRepository;
use App\Services\DTO\UrlEntity;
use Carbon\Carbon;

class RedisUrlRepository implements UrlRepository
{
    const SECONDS_IN_HOUR = 3600;

    public function __construct(
        private readonly RedisRepository $redisRepository,
    ) {
    }

    public function store(UrlEntity $urlEntity, string $hash): void
    {
        $data = $urlEntity->toArray();
        $data['createdTime'] = Carbon::now()->getTimestamp();
        $this->redisRepository->setByKey($hash, $data, $urlEntity->getLifetime() * self::SECONDS_IN_HOUR);
    }

    public function get(string $hash): ?UrlEntity
    {
        $data = $this->redisRepository->getByKey($hash);
        if (!$data) {
            return null;
        }

        return UrlEntity::fromArray($data);
    }

    public function update(UrlEntity $urlEntity, string $hash): void
    {
        $this->delete($hash);
        $deadlineTime = $urlEntity->getCreatedTime() + $urlEntity->getLifetime() * self::SECONDS_IN_HOUR;
        $ttl = $deadlineTime - Carbon::now()->getTimestamp();
        if ($ttl < 0) {
            return;
        }

        $this->redisRepository->setByKey($hash, $urlEntity->toArray(), $ttl);
    }

    public function delete(string $hash): void
    {
        $this->redisRepository->deleteByKey($hash);
    }

    public function exists(string $hash): bool
    {
        return $this->redisRepository->hasKey($hash);
    }
}
