@extends('layouts.default')

@section('title')
    Création de site web CMS et vitrine à Bordeaux - UpDaz
@endsection

@section('meta-description')
    Créez votre site CMS et site vitrine grâce à Webflow un outils en ligne no-code. Obtenez un site moderne et
    performant tout en gardant la main sur son contenu.
@endsection

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
