@php
    $result = json_encode(
        [
            '@context' => 'https://schema.org/',
            '@type' => 'LocalBusiness',
            'name' => 'UpDaz',
            'email' => 'matthieu@updaz.fr',
            'priceRange' => "$",
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Bordeaux',
                'addressRegion' => 'Nouvelle-Aquitaine',
                'postalCode' => '33000',
                'addressCountry' => 'FR',
            ],
            'founder' => [
                '@type' => 'Person',
                '@id' => route('home') . '#presentation',
                'name' => 'Matthieu DAZORD',
                'jobTitle' => 'Développeur web freelance',
                'url' => route('home') . '#presentation',
                'image' => asset('img/profile.jpg'),
                'sameAs' => [
                    'https://fr.linkedin.com/in/matthieu-dazord',
                    'https://github.com/UpDaz',
                    'https://www.malt.fr/profile/matthieudazord',
                ],
            ],
            'logo' => asset('img/logo-blue.png'),
            'url' => route('home'),
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                    'opens' => '09:00',
                    'closes' => '18:00',
                ],
            ],
        ],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
    );
@endphp
<script type="application/ld+json">
{!! $result !!}
</script>
