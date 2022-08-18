<?php

namespace App\Http\Controllers;

use App\Services\Resolvers\UrlByHashResolver;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ShowUrlController extends Controller
{
    public function __construct(
        private readonly UrlByHashResolver $urlByHashResolver,
    ) {
    }

    public function __invoke(string $hash): RedirectResponse
    {
        try {
            $urlEntity = $this->urlByHashResolver->resolve($hash);
        } catch (NotFoundResourceException) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return response()->redirectTo($urlEntity->getUrl());
    }
}
