@php
    $result = json_encode(
        [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'ProfessionalService',
                    '@id' => route('home') . '#organization',
                    'name' => 'UpDaz',
                    'description' => 'Développeur web freelance à Bordeaux : applications métier et e-commerce sur mesure avec Laravel, sites vitrines avec Webflow.',
                    'email' => 'matthieu@updaz.fr',
                    'priceRange' => '€€',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => 'Bordeaux',
                        'addressRegion' => 'Nouvelle-Aquitaine',
                        'postalCode' => '33300',
                        'addressCountry' => 'FR',
                    ],
                    'areaServed' => [
                        ['@type' => 'City', 'name' => 'Bordeaux'],
                        ['@type' => 'AdministrativeArea', 'name' => 'Gironde'],
                        ['@type' => 'Country', 'name' => 'France'],
                    ],
                    'founder' => [
                        '@type' => 'Person',
                        '@id' => route('home') . '#matthieu-dazord',
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
                    'image' => asset('img/logo-blue.png'),
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
                [
                    '@type' => 'WebSite',
                    '@id' => route('home') . '#website',
                    'name' => 'UpDaz',
                    'url' => route('home'),
                    'inLanguage' => 'fr-FR',
                    'publisher' => ['@id' => route('home') . '#organization'],
                ],
            ],
        ],
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
    );
@endphp
<script type="application/ld+json">
{!! $result !!}
</script>
