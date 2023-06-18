<section class="-mt-24 bg-gradient-to-br from-blue-dark to-blue">
    <div class="px-8 py-16 pt-32 pb-24 bg-pattern-1 md:px-16">
        <div class="container flex flex-col items-center mx-auto md:flex-row">
            <div
                class="flex flex-col mb-24 lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 md:items-start md:text-left md:mb-0 md:-mt-24">
                <h1 class="hidden">
                    Création de site internet sur mesure à Bordeaux
                </h1>
                <div class="text-4xl font-bold text-white font-title md:text-5xl">
                    Vous souhaitez
                </div>
                <div class="relative w-full text-4xl font-bold text-orange font-title md:text-5xl">
                    <span
                        class="absolute left-0 w-full txt-rotate"
                        data-period="2000"
                        data-rotate='[ "créer un site vitrine ?", "créer une boutique en ligne ?", "créer une landing page ?", "développer un site sur mesure ?", "améliorer votre visibilité sur le web ?", "optimiser votre référencement naturel ?", "améliorer les performances de votre site ?", "discuter de votre projet ?" ]'></span>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <x-welcome-scroller/>
            </div>
        </div>
    </div>
</section>

@section('javascript')
    @parent
    <script src="{{ asset('js/welcome.js') }}" defer></script>
@endsection
