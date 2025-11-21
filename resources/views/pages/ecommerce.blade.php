@extends('layouts.default')

@section('title')
    Accompagnement boutique en ligne & e-commerce - UpDaz
@endsection

@section('meta-description')
    Développement de site e-commerce et de boutiques en ligne avec le framework Laravel. Accompagnement, optimisation, conseils, maintenance...
@endsection

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
        @include('elements.ecommerce.faq')
    </div>
@endsection
