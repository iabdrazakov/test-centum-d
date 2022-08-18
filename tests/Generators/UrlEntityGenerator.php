<?php

namespace Tests\Generators;

use App\Services\DTO\UrlEntity;
use Illuminate\Foundation\Testing\WithFaker;

final class UrlEntityGenerator
{
    use WithFaker;

    public function __construct()
    {
        $this->faker = $this->makeFaker();
    }

    public static function buildAndGenerate(array $data = []): UrlEntity
    {
        return self::build()->generate($data);
    }

    private static function build(): self
    {
        return new self();
    }

    private function generate(array $data): UrlEntity
    {
        return UrlEntity::fromArray(array_merge([
            'url' => $this->faker()->url,
            'clicksCount' => $this->faker()->numberBetween(),
            'lifetime' => $this->faker()->numberBetween(2, 24),
        ], $data));
    }
}
