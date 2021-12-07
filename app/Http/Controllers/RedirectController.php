<?php

namespace App\Http\Controllers;

use App\Services\UrlChecker;
use Illuminate\Http\Response;

class RedirectController extends Controller
{
    private UrlChecker $urlChecker;

    public function __construct(UrlChecker $urlChecker)
    {
        $this->urlChecker = $urlChecker;
    }

    public function redirect(string $shortKey)
    {
        $urlModel = $this->urlChecker->check($shortKey);

        if ($urlModel !== null) {
            return redirect($urlModel->url);
        }

        abort( Response::HTTP_NOT_FOUND);
    }

    public function secretRedirect(string $shortKey, string $secretKey)
    {
        $urlModel = $this->urlChecker->check($shortKey);

        if($urlModel !== null) {
            return redirect($urlModel->url);
        }

        abort(Response::HTTP_NOT_FOUND);
    }
}
