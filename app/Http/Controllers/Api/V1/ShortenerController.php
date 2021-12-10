<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlShortenerRequest;
use App\Http\Resources\UrlResource;
use App\Models\Url;
use App\Services\Shortener\ShortenerDataTransformer;
use App\Services\Shortener\ShortUrlFactory;
use Illuminate\Http\Request;

class ShortenerController extends Controller
{

    public function index()
    {
        return UrlResource::collection(Url::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UrlShortenerRequest $request, ShortUrlFactory $shortUrlFactory)
    {
        $dto = (new ShortenerDataTransformer())->fromRequest($request);

        $shortener = $shortUrlFactory->getShortenerStrategy($dto);

        return $shortener->create($dto);
    }

    /**
     * Display the specified resource.
     */
    public function show($shortKey)
    {
        $url = Url::where('short_key', $shortKey)->first();

        if ($url !== null) {
            return new UrlResource($url);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
