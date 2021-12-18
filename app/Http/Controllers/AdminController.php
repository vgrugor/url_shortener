<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\IUrlRepository;

class AdminController extends Controller
{
    public function index(IUrlRepository $urlRepository)
    {
        $urls = $urlRepository->getAll();

        return view('admin')->with('urls', $urls);
    }
}
