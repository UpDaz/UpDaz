@extends('layouts.default')

@section('content')
    <div class="w-full bg-blue -mt-24 pt-48 min-h-[calc(100vh-19rem)] pb-24">
        <div class="container mx-auto">
            <img src="{{ asset('img/illustrations/404.svg') }}" class="w-1/2 mx-auto" alt="Illustration présentation"
                title="404 erreur" />
            <p class="text-2xl text-center text-white font-title">Page introuvable</p>
            <div class="flex justify-center mt-4 *:inline-block *:w-auto">
                <x-button.primary href="{{ route('home') }}">
                    Retourner à l'accueil
                </x-button.primary>
            </div>
        </div>
    </div>
@endsection
