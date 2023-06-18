@extends('layouts.default')

@section('title')
    Mentions légales - UpDaz
@endsection

@section('meta-description')
    Mentions légales du site ww.updaz.fr
@endsection

@section('content')
    <div
        class="relative bg-gradient-to-br from-blue-dark to-blue text-white text-center -mt-24 overflow-hidden min-h-[50vh] md:min-h-0">
        <div class="px-8 py-16 pt-32 pb-24 bg-pattern-1 md:px-16">
            <div class="container mx-auto">
                <h1 class="mb-8 text-4xl font-bold font-title lg:text-6xl">Mentions légales</h1>
                <div class="text-sm text-center">
                    <x-breadcrumb :links="['Mentions légales' => route('legal-notices')]" />
                </div>
            </div>
        </div>
    </div>
    <div class="container px-8 py-16 mx-auto text-justify md:px-16 md:py-24">
        
        <h2 class="text-2xl">
            UPDAZ
        </h2>
        <div class="w-20 h-1 my-2 rounded bg-blue"></div>
        <p class="mb-2">
            Tous droits réservés
        </p>
        <p class="mb-2">
            Société dirigée par M. DAZORD Matthieu<br>
            Adresse : 33300 Bordeaux<br>
            SIREN : 815136171
        </p>

        <h2 class="mt-4 text-2xl">
            Site internet
        </h2>
        <div class="w-20 h-1 my-2 rounded bg-blue"></div>
        <p class="mb-2">
            Développé avec les technologies Laravel, TailwindCSS, AlpineJS
            <br>
            Base du design : Tailblocks
            <br>
            Icons : HeroIcons
        </p>

        <h2 class="mt-4 text-2xl">
            Illustrations et éléments graphiques
        </h2>
        <div class="w-20 h-1 my-2 rounded bg-blue"></div>
        <p class="mb-2">
            https://laravel.com/
            <br>
            https://prestashop.fr/
            <br/>
            https://tailwindui.com/
        </p>
    </div>
@endsection
