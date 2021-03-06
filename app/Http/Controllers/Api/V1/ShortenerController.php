<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlShortenerRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Repositories\Contracts\IUrlRepository;
use App\Services\Shortener\ShortenerDataTransformer;
use App\Services\Shortener\ShortUrlFactory;
use Illuminate\Http\Response;
use Log;
use Throwable;

class ShortenerController extends Controller
{
    private IUrlRepository $urlRepository;

    public function __construct(IUrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function index()
    {
        $urls = $this->urlRepository->getPopularUrlByUser(\Auth::id());
        return response()->json(UrlResource::collection($urls),Response::HTTP_OK);
    }

    public function store(UrlShortenerRequest $request, ShortUrlFactory $shortUrlFactory)
    {
        $dto = (new ShortenerDataTransformer())->fromRequest($request);

        try {
            $shortener = $shortUrlFactory->getShortenerStrategy($dto);

            return response()->json($shortener->create($dto), Response::HTTP_CREATED);
        } catch(Throwable $e) {
            Log::error($e->getMessage());

            return response()->json(['errors' => 'Something is wrong.'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(string $shortKey)
    {
        $url = $this->urlRepository->getUrlByShortKey($shortKey);

        if ($url !== null) {
            return response()->json(new UrlResource($url), Response::HTTP_OK);
        }

        return response()->json(['errors' => 'Not Found'], Response::HTTP_NOT_FOUND);
    }

    public function destroy(string $shortKey)
    {
        $url = $this->urlRepository->getUrlByShortKey($shortKey);

        if ($url !== null) {
            $url->delete();

            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json(['errors' => 'Not Found'], Response::HTTP_OK);
    }
}
