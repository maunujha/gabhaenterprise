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

    public function service(string $service): View
    {
        $pages = config('service_pages');

        // Resolve the content key from the SEO-friendly URL segment.
        $slug = collect($pages)->search(fn (array $p) => $p['path'] === $service);
        abort_if($slug === false, 404);

        $page = $pages[$slug];
        $bySlug = collect(config('company.services'))->keyBy('slug');
        $meta = $bySlug[$slug];

        $related = collect($page['related'])->map(fn (string $r) => [
            'title'   => $bySlug[$r]['title'],
            'summary' => $bySlug[$r]['summary'],
            'icon'    => $bySlug[$r]['icon'],
            'path'    => $pages[$r]['path'],
        ])->all();

        return view('pages.service', compact('slug', 'page', 'meta', 'related'));
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
