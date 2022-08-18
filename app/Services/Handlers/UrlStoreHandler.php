<?php

namespace App\Services\Handlers;

use App\Services\Generators\RandomHashGenerator;
use App\Services\Repositories\UrlRepository;
use App\Services\DTO\UrlEntity;

class UrlStoreHandler
{
    public function __construct(
        private readonly UrlRepository $urlRepository,
        private readonly RandomHashGenerator $randomHashGenerator,
    ) {
    }

    public function handle(UrlEntity $urlEntity): string
    {
        $hash = $this->randomHashGenerator->generate();
        if ($this->urlRepository->exists($hash)) {
            $this->handle($urlEntity);
        }

        $this->urlRepository->store($urlEntity, $hash);
        return $hash;
    }
}
