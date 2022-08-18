<?php

namespace Tests\Feature\Http;

use App\Http\Routes\WebRoutes;
use Tests\Generators\UrlEntityGenerator;
use Tests\TestCase;

class StoreUrlControllerTest extends TestCase
{
    /**
     * @group http
     */
    public function testStoreRedirectsWithoutErrors(): void
    {
        $urlEntity = UrlEntityGenerator::buildAndGenerate();
        $this->post(WebRoutes::storeUrl(), $urlEntity->toArray())
            ->assertRedirect(WebRoutes::home())
            ->assertSessionDoesntHaveErrors();
    }

    /**
     * @group http
     */
    public function testStoreRedirectsBack(): void
    {
        $data = [];
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertRedirect(WebRoutes::home())
            ->assertSessionHasErrors();
    }

    /**
     * @group http
     */
    public function testStoreWantStoreIfNoUrl(): void
    {
        $data = UrlEntityGenerator::buildAndGenerate()->toArray();
        unset($data['url']);
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertRedirect(WebRoutes::home())
            ->assertSessionHasErrors('url');
    }

    /**
     * @group http
     */
    public function testStoreWantStoreIfIncorrectUrl(): void
    {
        $data = UrlEntityGenerator::buildAndGenerate()->toArray();
        $data['url'] = $this->faker->word;
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertRedirect(WebRoutes::home())
            ->assertSessionHasErrors('url');
    }

    /**
     * @group http
     */
    public function testStoreWantStoreIfNoClicksCount(): void
    {
        $data = UrlEntityGenerator::buildAndGenerate()->toArray();
        unset($data['clicksCount']);
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertRedirect(WebRoutes::home())
            ->assertSessionHasErrors('clicksCount');
    }

    /**
     * @group http
     */
    public function testStoreWantStoreIfNonNumericClicksCount(): void
    {
        $data = UrlEntityGenerator::buildAndGenerate()->toArray();
        $data['clicksCount'] = $this->faker->word;
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertRedirect(WebRoutes::home())
            ->assertSessionHasErrors('clicksCount');
    }

    /**
     * @group http
     */
    public function testStoreWantStoreIfClicksCountLessThanZero(): void
    {
        $data = UrlEntityGenerator::buildAndGenerate()->toArray();
        $data['clicksCount'] = -1;
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertRedirect(WebRoutes::home())
            ->assertSessionHasErrors('clicksCount');
    }

    /**
     * @group http
     */
    public function testStoreWantStoreNoLifetime(): void
    {
        $data = UrlEntityGenerator::buildAndGenerate()->toArray();
        unset($data['lifetime']);
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertRedirect(WebRoutes::home())
            ->assertSessionHasErrors('lifetime');
    }

    /**
     * @group http
     */
    public function testStoreWantStoreIfNonNumericLifetime(): void
    {
        $data = UrlEntityGenerator::buildAndGenerate()->toArray();
        $data['lifetime'] = $this->faker->word;
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertRedirect(WebRoutes::home())
            ->assertSessionHasErrors('lifetime');
    }

    /**
     * @group http
     */
    public function testStoreWantStoreIfNonIntegerLifetime(): void
    {
        $data = UrlEntityGenerator::buildAndGenerate()->toArray();
        $data['lifetime'] = 0.1;
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertRedirect(WebRoutes::home())
            ->assertSessionHasErrors('lifetime');
    }

    /**
     * @group http
     */
    public function testStoreWantStoreIfZeroLifetime(): void
    {
        $data = UrlEntityGenerator::buildAndGenerate()->toArray();
        $data['lifetime'] = 0;
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertRedirect(WebRoutes::home())
            ->assertSessionHasErrors('lifetime');
    }

    /**
     * @group http
     */
    public function testStoreWantStoreIfLifetimeIsMoreThanMax(): void
    {
        $data = UrlEntityGenerator::buildAndGenerate()->toArray();
        $data['lifetime'] = 25;
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertRedirect(WebRoutes::home())
            ->assertSessionHasErrors('lifetime');
    }

    /**
     * @group http
     */
    public function testStoreHasHashedUrlInSession(): void
    {
        $data = UrlEntityGenerator::buildAndGenerate()->toArray();
        $this->post(WebRoutes::storeUrl(), $data)
            ->assertSessionHas('url');
    }
}
