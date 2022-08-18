<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Requests\StoreUrlRequest;
use App\Http\Routes\WebRoutes;
use App\Services\Handlers\UrlStoreHandler;
use Illuminate\Http\RedirectResponse;

class StoreUrlController extends Controller
{
    public function __construct(
        private readonly UrlStoreHandler $urlStoreHandler,
    ) {
    }

    public function __invoke(StoreUrlRequest $request): RedirectResponse
    {
        $dto = $request->getDTO();
        $hash = $this->urlStoreHandler->handle($dto);
        request()->session()->flash('url', WebRoutes::showUrl($hash));

        return response()->redirectToRoute(WebRoutes::HOME);
    }
}
