<!DOCTYPE HTML>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Création de site sur-mesure et CMS à Bordeaux - UpDaz')</title>
    <meta name="description" content="@yield('meta-description', 'Création de site vitrine Webflow et Wordpress, sur-mesure Laravel et e-commerce Prestashop. Accompagnement, développement et conseils pour projet web.')" />
    <meta name="keywords"
        content="Développeur web, Bordeaux, freelance, full-stach, site internet, Laravel, Prestashop, CMS, Webflow, accompagnement, HTML, CSS, JavaScript, SEO, conseils, digitalisation, web" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="index,follow" />
    <meta name="author" content="Matthieu Dazord" />
    <meta name="application-name" content="UpDaz" />
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">
    <x-canonical-url />
    @include('elements.fonts')
    @vite('resources/css/app.css')
    @include('elements.structured-data')
    @include('elements.google-analytics')
    @include('elements.axeptio')
</head>

<body class="text-white overflow-x-hiddenn bg-gradient-to-br from-blue-dark to-blue">
    <div class="relative">
        <div class="absolute top-0 left-0 w-4 h-full background"></div>
        <div class="absolute top-0 right-0 w-4 h-full background"></div>
        <div>
            @include('elements.menu')
            @yield('content')
        </div>
    </div>
    @include('elements.footer')
</body>

@vite('resources/js/app.js')
@yield('javascript')

</html>
