<?php

namespace App\Http\Middleware;

use App\Services\UrlChecker;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class UrlExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param \App\Services\Shortener\Shortener\Shortener\UrlChecker $urlChecker
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $urlChecker = App::make( UrlChecker::class);

        if ($urlChecker->check($request->path()) !== null) {
            return $next($request);
        }

        abort(Response::HTTP_NOT_FOUND);
    }
}
