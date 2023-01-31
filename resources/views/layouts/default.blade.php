<!DOCTYPE HTML>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>@yield('title', 'Développeur de site sur-mesure et CMS à Bordeaux - UpDaz')</title>
    <meta name="description" content="@yield('meta-description', 'Création de site vitrine Webflow et Wordpress, sur-mesure Laravel et e-commerce Prestashop. Accompagnement, développement et conseils pour projet web.')"/>
    <meta name="keywords" content="Développeur web, Bordeaux, freelance, full-stach, site internet, Laravel, Prestashop, CMS, Webflow, accompagnement, HTML, CSS, JavaScript, SEO, conseils, digitalisation, web"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="robots" content="index,follow" />
    <meta name="author" content="Matthieu Dazord"/>
    <meta name="application-name" content="UpDaz"/>

    <link rel="icon" type="image/png" href="{{ asset("img/favicon.png") }}" />

    <x-canonical-url />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://www.gstatic.com">
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700&display=swap" rel="stylesheet" defer async>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet" defer async>
    <link rel="stylesheet" href="{{ asset("css/app.css") }}" defer async>
    @include('elements.structured-data')
    @include('elements.google-analytics')
</head>
<body class="overflow-x-hiddenn">
    @include('elements.menu')
    @yield('content')
    @include('elements.footer')
</body>

<script src="{{ asset('js/app.js') }}" async defer></script>
@yield('javascript')

</html>
