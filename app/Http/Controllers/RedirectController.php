<?php

namespace App\Http\Controllers;

use App\Services\UrlService;

class RedirectController extends Controller
{
    //TODO: make construct and create SERVICE
    public function redirect(UrlService $service, string $shortKey)
    {
        $url = $service->getRedirectUrl($shortKey);

        if ($url !== null && $url->secret_key === null) {
            return redirect($url->url);
        }

        abort(404);
    }

    public function secretRedirect(UrlService $service, string $shortKey, string $secretKey)
    {
        $url = $service->getRedirectSecretUrl($shortKey, $secretKey);

        if($url !== null) {
            return redirect($url->url);
        }
        abort(404);
    }
}
