@extends('layouts.default')

@section('content')
    <div class="flex flex-col gap-8 md:gap-16">
        @include('elements.home.welcome')
        @include('elements.separators.right')
        <div>
            @include('elements.home.presentation')
            @include('elements.home.opquast')
        </div>
        @include('elements.separators.left')
        @include('elements.home.skills')
        @include('elements.separators.extern')
        @include('elements.home.references')
        @include('elements.separators.center')
        @include('elements.home.pricing')
        @include('elements.separators.left')
        @include('elements.home.articles')
        @include('elements.separators.extern')
        <div id="contact">
            @include('elements.contact')
        </div>
    </div>
@endsection
