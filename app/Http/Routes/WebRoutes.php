<?php

namespace App\Http\Routes;

final class WebRoutes
{
    const HOME = 'home';
    const URLS_STORE = 'urls.store';
    const URLS_SHOW = 'urls.show';

    public static function home(): string
    {
        return route(self::HOME);
    }

    public static function storeUrl(): string
    {
        return route(self::URLS_STORE);
    }

    public static function showUrl(string $hash): string
    {
        return route(self::URLS_SHOW, ['hash' => $hash]);
    }
}
