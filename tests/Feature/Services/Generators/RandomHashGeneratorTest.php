<?php

namespace Tests\Feature\Services\Generators;

use App\Services\Generators\RandomHashGenerator;
use Tests\TestCase;

class RandomHashGeneratorTest extends TestCase
{
    private function getRandomHashGenerator(): RandomHashGenerator
    {
        return app(RandomHashGenerator::class);
    }

    /**
     * @group Generators
     */
    public function testGenerateReturns8SymbolsString(): void
    {
        $str = $this->getRandomHashGenerator()->generate();
        $this->assertIsString($str);
        $this->assertEquals(8, strlen($str));
    }
}
