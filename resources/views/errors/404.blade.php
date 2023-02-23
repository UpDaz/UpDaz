@extends('layouts.default')

@section('content')
    <div class="w-full bg-blue -mt-24 pt-48 min-h-[calc(100vh-19rem)]">
        <div class="container mx-auto">
            <img src="{{ asset('img/illustrations/404.svg')}}" class="w-1/2 mx-auto" alt="Illustration présentation" title="404 erreur"/>
            <p class="text-2xl text-center font-title text-white">Page introuvable</p>
            <p class="text-center mt-4">
                <a href="{{ route('home') }}" class="inline-block text-center bg-orange hover:bg-blue-dark text-white px-6 py-3 mx-auto rounded shadow-md">Retourner à l'accueil</a>
            </p>
        </div>
    </div>
@endsection
