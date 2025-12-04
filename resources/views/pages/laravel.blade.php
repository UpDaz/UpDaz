@extends('layouts.default')

@section('title')
    Création de site sur-mesure à Bordeaux - UpDaz
@endsection

@section('meta-description')
    Développement d'application et de site web sur-mesure avec le framework Laravel. Accompagnement, conseils, maintenance...
@endsection

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
