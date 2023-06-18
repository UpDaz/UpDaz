@extends('layouts.default')

@section('content')
    @include('elements.home.welcome')
    @include('elements.home.presentation')
    @include('elements.home.opquast')
    @include('elements.home.skills')
    @include('elements.home.references')
    @include('elements.home.pricing')
    @include('elements.home.articles')
    <div id="contact">
        @include('elements.contact')
    </div>
@endsection
