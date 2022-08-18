<?php

namespace App\Http\Controllers\Requests;

use App\Services\DTO\UrlEntity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class StoreUrlRequest extends FormRequest
{
    public function response(array $errors): RedirectResponse
    {
        return Redirect::back()->withErrors($errors)->withInput();
    }

    public function rules(): array
    {
        return [
            'url' => 'required|url',
            'clicksCount' => 'required|numeric|int|gte:0',
            'lifetime' => 'required|numeric|int|min:1|max:' . UrlEntity::MAX_LIFETIME_HOURS,
        ];
    }

    public function getDTO(): UrlEntity
    {
        return UrlEntity::fromArray($this->validated());
    }
}
