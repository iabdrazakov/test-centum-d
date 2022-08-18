<?php

namespace App\Services\DTO;

use Illuminate\Contracts\Support\Arrayable;

final class UrlEntity implements Arrayable
{
    const MAX_LIFETIME_HOURS = 24;
    const INFINITE_CLICKS_COUNT = 0;

    private function __construct(
        private readonly string $url,
        private readonly int $clicksCount,
        private readonly int $lifetime,
        private readonly ?int $createdTime,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['url'] ?? '',
            $data['clicksCount'] ?? 0,
            $data['lifetime'] ?? self::MAX_LIFETIME_HOURS,
            $data['createdTime'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'url' => $this->getUrl(),
            'clicksCount' => $this->getClicksCount(),
            'lifetime' => $this->getLifetime(),
            'createdTime' => $this->getCreatedTime(),
        ];
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getClicksCount(): int
    {
        return $this->clicksCount;
    }

    public function getLifetime(): int
    {
        return $this->lifetime;
    }

    public function getCreatedTime(): ?int
    {
        return $this->createdTime;
    }

    public function isClicksInfinite(): bool
    {
        return $this->getClicksCount() === self::INFINITE_CLICKS_COUNT;
    }
}
