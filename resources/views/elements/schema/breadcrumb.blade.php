@php
    $items = ['Accueil' => route('home')] + $links;

    $result = json_encode(
        [
            '@context' => 'https://schema.org/',
            '@type' => 'BreadcrumbList',
            'itemListElement' => collect(array_keys($items))
                ->map(fn (string $label, int $index): array => [
                    '@type' => 'ListItem',
                    'position' => $index + 1,
                    'name' => $label,
                    'item' => $items[$label],
                ])
                ->all(),
        ],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
    );
@endphp
<script type="application/ld+json">
{!! $result !!}
</script>
