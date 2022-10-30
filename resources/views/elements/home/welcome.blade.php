<div id="welcome" class="w-full bg-blue px-8 md:px-16 py-16 md:py-24 md:-mt-24 flex items-center h-[calc(100vh-4rem)] md:h-[calc(100vh+2rem)]">
    <div class="container mx-auto md:-mt-20">
        <h1 class="hidden">
            Création de site internet sur mesure à Bordeaux
        </h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 flex items-center justify-between w-full">
            <div class="lg:-mt-20">
                <div class="text-center md:text-left text-white font-title text-4xl lg:text-6xl font-bold">
                    Je veux
                </div>
                <div class="text-orange font-title text-4xl lg:text-6xl font-bold relative">
                    <span
                        class="txt-rotate absolute w-full text-center md:text-left"
                        data-period="2000"
                        data-rotate='[ "un site vitrine.", "une boutique en ligne.", "une landing page", "une plateforme de réservation.", "un site sur mesure.", "améliorer ma visibilité sur le web.", "optimiser mon référencement naturel.", "améliorer les performances de mon site.", "créer mon projet." ]'></span>
                </div>
            </div>
            <div class="mt-40 lg:mt-0 -ml-6 md:ml-0 w-[calc(100%+3rem)] md:w-full">
                @include('elements/illustrations/welcome')
            </div>
        </div>
    </div>
</div>

@section('javascript')
@parent
<script src="{{ asset('js/welcome.js') }}" async defer></script>
@endsection

