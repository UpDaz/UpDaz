@extends('layouts.default')

@section('title', 'Création d’applications web Laravel à Bordeaux – UpDaz')

@section('meta-description', 'Développeur Laravel à Bordeaux : création d’applications web métier sur mesure (CRM, outils internes, API, e-commerce). Accompagnement, développement et maintenance.')

@push('structured-data')
    @include('elements.schema.service', [
        'name' => 'Développement d’applications web Laravel à Bordeaux',
        'serviceType' => 'Développement d’applications web sur mesure',
        'description' => 'Création, reprise et maintenance d’applications web métier sur mesure avec Laravel : CRM, outils internes, extranets, API et e-commerce.',
        'url' => route('laravel'),
    ])
    @include('elements.schema.breadcrumb', [
        'links' => ['Application web Laravel' => route('laravel')],
    ])
@endpush

@section('content')
    @include('elements.laravel.header')
    @include('elements.separators.right')
    <div class="flex flex-col gap-16">
        <div class="flex flex-col">
            @include('elements.laravel.presentation')
            @include('elements.laravel.why')
            @include('elements.laravel.maintenance')
        </div>
        @include('elements.separators.center')
        @include('elements.laravel.support')
        @include('elements.separators.left')
        @include('elements.laravel.stack')
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
