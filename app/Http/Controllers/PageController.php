<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function capabilities(): View
    {
        return view('pages.capabilities');
    }

    public function industries(): View
    {
        return view('pages.industries');
    }

    public function whyChooseUs(): View
    {
        return view('pages.why-choose-us');
    }

    public function faqs(): View
    {
        return view('pages.faqs');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }
}
