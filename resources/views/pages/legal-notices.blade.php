@extends('layouts.default')

@section('title')
    Mentions légales - UpDaz
@endsection

@section('meta-description')
    Mentions légales du site ww.updaz.fr
@endsection

@section('content')
    <div class="container flex flex-col gap-16 mx-auto">
        <div class="relative mt-24 overflow-hidden text-center text-white ">
            <div class="flex flex-col gap-4 mx-auto">
                <h1 class="text-4xl font-bold font-title lg:text-5xl">Mentions légales</h1>
                <h2 class="text-xl ">Retrouvez toute l'actualité UpDaz</h2>
                <div class="flex flex-col gap-4 text-sm text-center">
                    <div data-element="line-horizontal" class="h-[1px] w-1/4 mx-auto"></div>
                    <x-breadcrumb :links="['Mentions légales' => route('legal-notices')]" />
                </div>
            </div>
        </div>
        <div class="max-w-lg mx-auto">
            <h2 class="text-2xl">
                UPDAZ
            </h2>
            <p class="mb-4">
                Tous droits réservés
            </p>
            <p class="mb-4">
                Société dirigée par M. DAZORD Matthieu<br>
                Adresse : 33300 Bordeaux<br>
                SIREN : 815136171
            </p>

            <h2 class="mt-4 text-2xl">
                Site internet
            </h2>
            <p class="mb-4">
                Développé par UpDaz avec les technologies Laravel, TailwindCSS, AlpineJS
                <br>
                Base du design : Tailblocks
                <br>
                Icons : https://www.streamlinehq.com/icons/freehand-duotone-free
                <br>
                Hébergement : ZakaServices
            </p>
            <h2 class="mt-4 text-2xl">
                Illustrations et éléments graphiques
            </h2>
            <p class="mb-4">
                https://laravel.com/
                <br />
                https://tailwindui.com/
                <br/>
                https://www.streamlinehq.com/icons/freehand-duotone-free
            </p>
        </div>
    @endsection
