<?php

namespace App\Services\Resolvers;

use App\Services\DTO\UrlEntity;
use App\Services\Handlers\DecreaseUrlClicksCountHandler;
use App\Services\Repositories\UrlRepository;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class UrlByHashResolver
{
    public function __construct(
        private readonly UrlRepository $urlRepository,
        private readonly DecreaseUrlClicksCountHandler $decreaseUrlClicksCountHandler,
    ) {
    }

    /**
     * @param string $hash
     * @return UrlEntity
     * @throws NotFoundResourceException
     */
    public function resolve(string $hash): UrlEntity
    {
        $urlEntity = $this->urlRepository->get($hash);
        if (!$urlEntity) {
            throw new NotFoundResourceException();
        }
        $this->decreaseUrlClicksCountHandler->handle($urlEntity, $hash);

        return $urlEntity;
    }
}
