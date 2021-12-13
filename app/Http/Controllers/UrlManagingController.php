<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\IUrlRepository;
use Illuminate\Http\Request;

class UrlManagingController extends Controller
{
    public function index(IUrlRepository $urlRepository)
    {
        $urls = $urlRepository->getAll();

        return view('managing-urls')->with(['urls' => $urls]);
    }
}
