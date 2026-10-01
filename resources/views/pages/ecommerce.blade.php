@extends('layouts.default')

@section('title', 'Création de site e-commerce sur mesure à Bordeaux – UpDaz')

@section('meta-description', 'Site e-commerce sur mesure à Bordeaux avec Laravel et Lunar : coûts maîtrisés, sans commission ni abonnement, données hébergées en France.')

@push('structured-data')
    @include('elements.schema.service', [
        'name' => 'Création de site e-commerce sur mesure à Bordeaux',
        'serviceType' => 'Développement de site e-commerce sur mesure',
        'description' => 'Développement de boutiques en ligne sur mesure avec Laravel et Lunar : catalogue, commande B2B, stocks, intégrations logistiques, migration depuis Prestashop ou Shopify et maintenance.',
        'url' => route('ecommerce'),
    ])
    @include('elements.schema.breadcrumb', [
        'links' => [
            'Application web Laravel' => route('laravel'),
            'E-commerce sur mesure' => route('ecommerce'),
        ],
    ])
@endpush

@section('content')
    @include('elements.ecommerce.header')
    @include('elements.separators.right')
    <div class="flex flex-col gap-16">
        <div class="flex flex-col">
            @include('elements.ecommerce.why')
            @include('elements.ecommerce.audience')
        </div>
        @include('elements.separators.center')
        @include('elements.ecommerce.use-case')
        @include('elements.separators.left')
        <div class="flex flex-col">
            @include('elements.ecommerce.presentation')
            @include('elements.ecommerce.migration')
        </div>
        @include('elements.separators.extern')
        @include('elements.ecommerce.support')
        @include('elements.separators.left')
        <div id="contact">
            @include('elements.ecommerce.contact')
        </div>
        @include('elements.separators.right')
        @include('elements.ecommerce.articles')
        @include('elements.separators.extern')
        @include('elements.ecommerce.faq')
    </div>
@endsection
