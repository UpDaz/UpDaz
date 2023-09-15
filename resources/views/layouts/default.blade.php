<!DOCTYPE HTML>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>@yield('title', 'Création de site sur-mesure et CMS à Bordeaux - UpDaz')</title>
    <meta name="description" content="@yield('meta-description', 'Création de site vitrine Webflow et Wordpress, sur-mesure Laravel et e-commerce Prestashop. Accompagnement, développement et conseils pour projet web.')"/>
    <meta name="keywords" content="Développeur web, Bordeaux, freelance, full-stach, site internet, Laravel, Prestashop, CMS, Webflow, accompagnement, HTML, CSS, JavaScript, SEO, conseils, digitalisation, web"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="robots" content="index,follow" />
    <meta name="author" content="Matthieu Dazord"/>
    <meta name="application-name" content="UpDaz"/>

    <link rel="icon" href="{{ asset("img/favicon.png") }}" />

    <x-canonical-url />

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700&display=swap" rel="stylesheet" defer>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,400;1,700&display=swap" rel="stylesheet" defer>
    <link rel="stylesheet" href="{{ mix("css/app.css") }}" defer>
    @include('elements.structured-data')
    @include('elements.google-analytics')
    @include('elements.axeptio')
</head>
<body class="overflow-x-hiddenn">
    @include('elements.menu')
    @yield('content')
    @include('elements.footer')
</body>

<script src="{{ mix('js/app.js') }}" defer></script>
@yield('javascript')

</html>
