<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Public URLs, highest priority first. Kept in code (not the DB) —
     * the site is a fixed set of marketing routes.
     *
     * @var list<array{route: string, priority: string, freq: string}>
     */
    private array $urls = [
        ['route' => 'home',         'priority' => '1.0', 'freq' => 'weekly'],
        ['route' => 'services',     'priority' => '0.9', 'freq' => 'monthly'],
        ['route' => 'capabilities', 'priority' => '0.8', 'freq' => 'monthly'],
        ['route' => 'industries',   'priority' => '0.8', 'freq' => 'monthly'],
        ['route' => 'why',          'priority' => '0.7', 'freq' => 'monthly'],
        ['route' => 'about',        'priority' => '0.7', 'freq' => 'monthly'],
        ['route' => 'faqs',         'priority' => '0.6', 'freq' => 'monthly'],
        ['route' => 'contact',      'priority' => '0.6', 'freq' => 'yearly'],
    ];

    public function __invoke(): Response
    {
        $entries = array_map(fn (array $u) => [
            'loc'      => route($u['route']),
            'priority' => $u['priority'],
            'freq'     => $u['freq'],
        ], $this->urls);

        // Dedicated service pages (hub-and-spoke under /manufacturing-services).
        foreach (config('service_pages') as $page) {
            $entries[] = [
                'loc'      => route('services.show', $page['path']),
                'priority' => '0.8',
                'freq'     => 'monthly',
            ];
        }

        return response()
            ->view('sitemap', ['entries' => $entries, 'lastmod' => now()->toAtomString()])
            ->header('Content-Type', 'application/xml');
    }
}
