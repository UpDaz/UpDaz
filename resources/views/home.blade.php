@extends('layouts.default')

@section('content')
    @include('elements.welcome')
    @include('elements.presentation')
    @include('elements.references')
    @include('elements.pricing')
    {{-- @include('elements.your-project') --}}
    {{-- @include('elements.services') --}}
    <div class="bg-white px-8 md:px-16 py-16 md:py-24">
        @include('elements.contact')
    </div>
@endsection
