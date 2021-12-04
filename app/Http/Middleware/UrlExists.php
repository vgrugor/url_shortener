<?php

namespace App\Http\Middleware;

use App\Repositories\Contracts\IUrlRepository;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UrlExists
{
    private IUrlRepository $urlRepository;

    public function __construct(IUrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $urlExists = $this->urlRepository->getUrlByShortKey($request->path());

        if (count(explode('/', $request->path())) > 1) {
            [$shortKey, $secretKey] = explode('/', $request->path());
            $urlExists = $this->urlRepository->getSecretUrlByShortKey($shortKey, $secretKey);
        }

        if ($urlExists) {
            return $next($request);
        }

        abort(Response::HTTP_NOT_FOUND);
    }
}
