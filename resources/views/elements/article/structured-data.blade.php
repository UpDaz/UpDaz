<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "NewsArticle",
    "headline": "{{ $article->title }}",
    "datePublished": "{{ $article->published_at->format('Y-m-d') }}T08:00:00+01:00",
    "articleBody": "{{ $article->content }}",
    "articleSection": "{{ $article->category->name }}",
    "author": {
        "@type": "Person",
        "name": "Matthieu Dazord",
        "url": "{{ Request::url() }}"
    }
  }
</script>
