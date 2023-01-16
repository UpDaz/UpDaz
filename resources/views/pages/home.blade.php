@extends('layouts.default')

@section('content')
    @include('elements.home.welcome')
    @include('elements.home.presentation')
    @include('elements.home.opquast')
    @include('elements.home.references')
    @include('elements.home.pricing')
    @include('elements.home.articles')
    <div class="bg-white px-8 md:px-16 py-16 md:py-24" id="contact">
        @include('elements.contact')
    </div>
@endsection
