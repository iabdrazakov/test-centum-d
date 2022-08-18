<?php

namespace App\Services\Handlers;

use App\Services\DTO\UrlEntity;
use App\Services\Repositories\UrlRepository;

class DecreaseUrlClicksCountHandler
{
    public function __construct(
        private readonly UrlRepository $urlRepository,
    ) {
    }

    public function handle(UrlEntity $urlEntity, string $hash): void
    {
        if ($urlEntity->isClicksInfinite()) {
            return;
        }

        $count = $urlEntity->getClicksCount() - 1;
        if ($count === 0) {
            $this->urlRepository->delete($hash);
            return;
        }

        $urlEntity = UrlEntity::fromArray(array_merge($urlEntity->toArray(), [
            'clicksCount' => $count,
        ]));

        $this->urlRepository->update($urlEntity, $hash);
    }
}
