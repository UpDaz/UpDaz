@extends('layouts.default')

@section('title', 'Création de site Webflow à Bordeaux – UpDaz')

@section('meta-description', 'Développeur Webflow à Bordeaux : création de sites vitrines et CMS modernes, rapides et bien référencés, dont vous gardez la main sur le contenu. Design, intégration et SEO.')

@push('structured-data')
    @include('elements.schema.service', [
        'name' => 'Création de site Webflow à Bordeaux',
        'serviceType' => 'Création de site vitrine et CMS avec Webflow',
        'description' => 'Conception de sites vitrines et CMS avec Webflow : design, intégration, optimisation SEO et formation à la gestion du contenu.',
        'url' => route('webflow'),
    ])
    @include('elements.schema.breadcrumb', [
        'links' => ['Création de site Webflow' => route('webflow')],
    ])
@endpush

@section('content')
    @include('elements.webflow.header')
    @include('elements.separators.right')
    <div class="flex flex-col gap-16">
        @include('elements.webflow.presentation')
        @include('elements.webflow.why')
        @include('elements.separators.center')
        @include('elements.webflow.support')
        @include('elements.separators.extern')
        @include('elements.webflow.references')
        @include('elements.separators.left')
        <div id="contact">
            @include('elements.webflow.contact')
        </div>
        @include('elements.separators.right')
        @include('elements.webflow.articles')
        @include('elements.separators.extern')
        @include('elements.webflow.faq')
    </div>
@endsection
