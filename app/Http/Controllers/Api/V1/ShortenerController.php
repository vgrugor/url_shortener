<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlShortenerRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Services\Shortener\ShortenerDataTransformer;
use App\Services\Shortener\ShortUrlFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShortenerController extends Controller
{

    public function index()
    {
        return response()->json(
            UrlResource::collection(Url::all()),
            Response::HTTP_OK
        );
    }

    public function store(UrlShortenerRequest $request, ShortUrlFactory $shortUrlFactory)
    {
        $dto = (new ShortenerDataTransformer())->fromRequest($request);

        $shortener = $shortUrlFactory->getShortenerStrategy($dto);

        return response()->json(
            $shortener->create($dto),
            Response::HTTP_CREATED
        );
    }

    public function show(string $shortKey)
    {
        $url = Url::where('short_key', $shortKey)->first();

        if ($url !== null) {
            return new UrlResource($url);
        }
    }

    public function update(Request $request, $id)
    {
        //TODO: add code
    }

    public function destroy(string $shortKey)
    {
        $url = Url::where('short_key', $shortKey)->first();

        if ($url !== null) {
            $url->delete();
        }

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
