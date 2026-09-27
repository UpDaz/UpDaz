@php
    $result = json_encode(
        [
            '@context' => 'https://schema.org/',
            '@type' => 'FAQPage',
            'mainEntity' => collect($questions)
                ->map(fn (string $answer, string $question): array => [
                    '@type' => 'Question',
                    'name' => $question,
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $answer,
                    ],
                ])
                ->values()
                ->all(),
        ],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
    );
@endphp
<script type="application/ld+json">
{!! $result !!}
</script>
