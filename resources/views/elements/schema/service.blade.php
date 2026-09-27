@php
    $result = json_encode(
        [
            '@context' => 'https://schema.org/',
            '@type' => 'Service',
            'name' => $name,
            'serviceType' => $serviceType,
            'description' => $description,
            'url' => $url,
            'provider' => [
                '@type' => 'LocalBusiness',
                'name' => 'UpDaz',
                'url' => route('home'),
            ],
            'areaServed' => [
                ['@type' => 'City', 'name' => 'Bordeaux'],
                ['@type' => 'City', 'name' => 'Mérignac'],
                ['@type' => 'City', 'name' => 'Pessac'],
                ['@type' => 'AdministrativeArea', 'name' => 'Gironde'],
                ['@type' => 'Country', 'name' => 'France'],
            ],
        ],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
    );
@endphp
<script type="application/ld+json">
{!! $result !!}
</script>
