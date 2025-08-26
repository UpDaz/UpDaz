@php
    $result = json_encode(
        [
           "@context" => "https://schema.org",
        "@type" => "NewsArticle",
        "headline" => "{{ $article->title }}",
        "datePublished" => "{{ $article->published_at->format('Y-m-d') }}T08:00:00+01:00",
        "articleSection" => "{{ $article->category->name }}",
        "author" => [
            "@type" => "Organism",
            "name" => "UpDaz",
            "url" => "{{ Request::url() }}"
        ]
        ],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
    );
@endphp

<script type="application/ld+json">
{{ $result }}
</script>
