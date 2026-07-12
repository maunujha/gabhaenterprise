<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class BlogController extends Controller
{
    /**
     * Content hub index. Draft posts are shown (marked) for review but the
     * page is noindex until at least one post is published.
     */
    public function index(): View
    {
        $posts = config('blog.posts');

        return view('pages.blog.index', [
            'posts'        => $posts,
            'clusters'     => config('blog.clusters'),
            'hasPublished' => (bool) array_filter($posts, fn ($p) => ($p['status'] ?? '') === 'published'),
        ]);
    }

    /**
     * A single guide. Resolves the internal-link maps (blog → service,
     * blog → blog) and the parent pillar for cluster posts.
     */
    public function show(string $post): View
    {
        $posts = config('blog.posts');
        abort_unless(isset($posts[$post]), 404);

        $data = $posts[$post];

        $services = collect(config('company.services'))->keyBy('slug');
        $pages = config('service_pages');

        $relatedServices = collect($data['related_services'] ?? [])
            ->filter(fn ($s) => isset($services[$s], $pages[$s]))
            ->map(fn ($s) => [
                'title' => $services[$s]['title'],
                'icon'  => $services[$s]['icon'],
                'path'  => $pages[$s]['path'],
            ])->values()->all();

        $relatedPosts = collect($data['related_posts'] ?? [])
            ->filter(fn ($s) => isset($posts[$s]))
            ->map(fn ($s) => [
                'slug'    => $s,
                'title'   => $posts[$s]['h1'],
                'excerpt' => $posts[$s]['excerpt'],
                'type'    => $posts[$s]['type'],
            ])->values()->all();

        $pillar = null;
        if (! empty($data['pillar']) && isset($posts[$data['pillar']])) {
            $pillar = ['slug' => $data['pillar'], 'title' => $posts[$data['pillar']]['h1']];
        }

        return view('pages.blog.show', [
            'slug'            => $post,
            'post'            => $data,
            'relatedServices' => $relatedServices,
            'relatedPosts'    => $relatedPosts,
            'pillar'          => $pillar,
        ]);
    }
}
