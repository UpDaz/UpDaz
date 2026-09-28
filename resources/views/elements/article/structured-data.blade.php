@php
    $articleUrl = $article->category
        ? route('article', ['categorySlug' => $article->category->slug, 'slug' => $article->slug])
        : url()->current();

    $result = json_encode(
        [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $article->title,
            'description' => $article->meta_description,
            'datePublished' => $article->published_at->toIso8601String(),
            'dateModified' => ($article->updated_at ?? $article->published_at)->toIso8601String(),
            'mainEntityOfPage' => $articleUrl,
            'url' => $articleUrl,
            'inLanguage' => 'fr-FR',
            'articleSection' => $article->categories->pluck('name')->all(),
            'author' => [
                '@type' => 'Person',
                'name' => 'Matthieu UpDaz',
                'url' => route('home'),
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'UpDaz',
                'url' => route('home'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('img/logo-blue.png'),
                ],
            ],
        ],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
    );
@endphp

<script type="application/ld+json">
{!! $result !!}
</script>
