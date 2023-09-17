@extends('layouts.default')

@section('content')
    <div class="w-full bg-blue -mt-24 pt-48 min-h-[calc(100vh-19rem)] pb-24">
        <div class="container mx-auto">
            <img src="{{ asset('img/illustrations/404.svg')}}" class="w-1/2 mx-auto" alt="Illustration présentation" title="404 erreur"/>
            <p class="text-2xl text-center text-white font-title">Page introuvable</p>
            <p class="mt-4 text-center">
                <a href="{{ route('home') }}" class="inline-block px-6 py-3 mx-auto text-center text-white rounded shadow-md bg-orange hover:bg-blue-dark">Retourner à l'accueil</a>
            </p>
        </div>
    </div>
@endsection
