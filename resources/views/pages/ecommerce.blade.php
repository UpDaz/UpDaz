@extends('layouts.default')

@section('title', 'Création de site e-commerce sur mesure à Bordeaux – UpDaz')

@section('meta-description', 'Création de site e-commerce sur mesure à Bordeaux avec Laravel et Lunar : catalogue, paiement, intégrations ERP et CRM, sans commission ni abonnement. Développement et maintenance.')

@push('structured-data')
    @include('elements.schema.service', [
        'name' => 'Création de site e-commerce sur mesure à Bordeaux',
        'serviceType' => 'Développement de site e-commerce sur mesure',
        'description' => 'Développement de boutiques en ligne sur mesure avec Laravel et Lunar : catalogue, paiement, intégrations ERP et CRM, maintenance.',
        'url' => route('ecommerce'),
    ])
    @include('elements.schema.breadcrumb', [
        'links' => ['Création de site e-commerce' => route('ecommerce')],
    ])
@endpush

@section('content')
    @include('elements.ecommerce.header')
    @include('elements.separators.right')
    <div class="flex flex-col gap-16">
        @include('elements.ecommerce.presentation')
        @include('elements.ecommerce.why')
        @include('elements.separators.center')
        @include('elements.ecommerce.support')
        @include('elements.separators.extern')
        @include('elements.ecommerce.references')
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
