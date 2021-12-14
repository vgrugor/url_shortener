<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\IUrlRepository;
use Illuminate\Http\Request;
use Log;

class UrlManagingController extends Controller
{
    private IUrlRepository $urlRepository;

    public function __construct(IUrlRepository $urlRepository)
    {
        $this->urlRepository = $urlRepository;
    }

    public function index()
    {
        $urls = $this->urlRepository->getAll();

        return view('managing-urls')->with(['urls' => $urls]);
    }

    public function destroy(string $shortKey)
    {
        $url = $this->urlRepository->getUrlByShortKey($shortKey);

        if ($url !== null) {
            $url->delete();

            return redirect()->route('managing-urls')
                ->with('message', 'Short Key is deleted!');
        }

        Log::warning("Can't find the short key $shortKey");

        return back()->with(['error' => "Something is wrong. Can't find the short key $shortKey"]);
    }
}
