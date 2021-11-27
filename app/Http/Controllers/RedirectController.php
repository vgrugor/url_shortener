<?php

namespace App\Http\Controllers;

use App\Services\UrlService;
use Illuminate\Http\Response;

class RedirectController extends Controller
{
    private UrlService $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    public function redirect(string $shortKey)
    {
        $urlModel = $this->urlService->getRedirectUrl($shortKey);

        if ($urlModel !== null && $urlModel->secret_key === null) {
            return redirect($urlModel->url);
        }
        abort( Response::HTTP_NOT_FOUND);
    }

    public function secretRedirect(string $shortKey, string $secretKey)
    {
        $urlModel = $this->urlService->getRedirectSecretUrl($shortKey, $secretKey);

        if($urlModel !== null) {
            return redirect($urlModel->url);
        }
        abort(Response::HTTP_NOT_FOUND);
    }
}
