<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlShortenerRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Services\Shortener\ShortenerDataTransformer;
use App\Services\Shortener\ShortUrlFactory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShortenerController extends Controller
{

    public function index()
    {
        return response()->json(UrlResource::collection(Url::all()),Response::HTTP_OK);
    }

    public function store(UrlShortenerRequest $request, ShortUrlFactory $shortUrlFactory)
    {
        $dto = (new ShortenerDataTransformer())->fromRequest($request);

        $shortener = $shortUrlFactory->getShortenerStrategy($dto);

        try {
            return response()->json($shortener->create($dto), Response::HTTP_CREATED);
        } catch(Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(string $shortKey)
    {
        $url = Url::where('short_key', $shortKey)->first();

        if ($url !== null) {
            return response()->json(new UrlResource($url), Response::HTTP_OK);
        }

        return response()->json(['errors' => 'Not Found'], Response::HTTP_NOT_FOUND);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(string $shortKey)
    {
        $url = Url::where('short_key', $shortKey)->first();

        if ($url !== null) {
            $url->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json(['errors' => 'Not Found'], Response::HTTP_BAD_REQUEST);
    }
}
