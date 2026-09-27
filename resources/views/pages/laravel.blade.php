@extends('layouts.default')

@section('title', 'Création d’applications web Laravel à Bordeaux – UpDaz')

@section('meta-description', 'Développeur Laravel à Bordeaux : création d’applications web métier sur mesure (CRM, outils internes, API, e-commerce). Accompagnement, développement et maintenance.')

@section('content')
    @include('elements.laravel.header')
    @include('elements.separators.right')
    <div class="flex flex-col gap-16">
        @include('elements.laravel.presentation')
        @include('elements.laravel.why')
        @include('elements.separators.center')
        @include('elements.laravel.support')
        @include('elements.separators.extern')
        @include('elements.laravel.references')
        @include('elements.separators.left')
        <div id="contact">
            @include('elements.laravel.contact')
        </div>
        @include('elements.separators.right')
        @include('elements.laravel.articles')
        @include('elements.separators.extern')
        @include('elements.laravel.faq')
    </div>
@endsection
