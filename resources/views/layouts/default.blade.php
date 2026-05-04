<!DOCTYPE HTML>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Développement et maintenant d\'application web Laravel et CMS Webflow à Bordeaux - UpDaz')</title>
    <meta name="description" content="@yield('meta-description', 'Développement d\'applications web métier et e-commerce avec Laravel et de sites web CMS avec Webflow. Accompagnement, conseils, développement et maintenance pour vos projet web.')" />
    <meta name="keywords"
        content="Développeur web, Bordeaux, application web, freelance, full-stack, site internet, Laravel, CMS, Webflow, accompagnement, HTML, CSS, JavaScript, SEO, conseils, digitalisation, web" />
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

<body class="text-white overflow-x-hiddenn bg-linear-to-br from-blue to-blue-dark">
    <div class="relative">
        <div class="absolute top-0 left-0 w-2 h-full md:w-4 background"></div>
        <div class="absolute top-0 right-0 w-2 h-full md:w-4 background"></div>
        <div class="min-h-[90vh]">
            @include('elements.menu')
            <div class="md:-mt-24 md:pt-24">
                @yield('content')
            </div>
        </div>
    </div>
    @include('elements.footer')
</body>

@vite('resources/js/app.js')
@yield('javascript')

</html>
