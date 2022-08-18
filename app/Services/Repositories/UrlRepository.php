<?php

namespace App\Services\Repositories;

use App\Services\DTO\UrlEntity;

interface UrlRepository
{
    public function store(UrlEntity $urlEntity, string $hash): void;

    public function get(string $hash): ?UrlEntity;

    public function delete(string $hash): void;

    public function update(UrlEntity $urlEntity, string $hash): void;

    public function exists(string $hash): bool;
}
