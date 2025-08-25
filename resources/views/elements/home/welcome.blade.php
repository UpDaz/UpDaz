<section class="flex items-center justify-center h-[100vh]">
    <div class="container flex flex-col items-center mx-auto md:flex-row">
        <div class="flex flex-col gap-12 lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 md:items-start md:text-left md:mb-0">
            <div>
                <div class="w-16 mb-6">
                    @include('elements.icon.www')
                </div>
                <h1 class="text-3xl font-bold text-white font-title md:text-5xl txt-rotate">
                    Architecte<br/>du web
                </h1>
            </div>
            <h2>Développeur d'<span class="text-yellow">application web sur-mesure</span> et de <span
                    class="text-yellow">sites internet</span> sur Bordeaux</h2>
            <div class="grid *:w-full gap-4 lg:grid-cols-2 xl:grid-cols-3 w-full">
                <x-button.secondary href="#presentation" @click.prevent="scrollToTarget('#presentation')"
                    title="Présentation UpDaz">
                    Qui suis-je ?
                </x-button.secondary>
                <x-button.secondary href="#competences" @click.prevent="scrollToTarget('#competences')"
                    title="Compétences et savoir-faire">
                    Savoir-faire
                </x-button.secondary>
                <x-button.secondary href="#offres" @click.prevent="scrollToTarget('#offres')" title="Offres">
                    Offres
                </x-button.secondary>
                <div class="xl:col-span-3 lg:col-span-2">
                    <x-button.primary href="#contact" title="UpDaz : formulaire de contact"
                        @click.prevent="scrollToTarget('#contact')" classes="lg:col-span-2 xl:col-span-3">
                        Me contacter
                    </x-button-primary>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2">
            {{-- <x-welcome-scroller /> --}}
        </div>
        <div class="absolute w-8 -translate-x-1/2 bottom-4 left-1/2">
            @include('elements.icon.arrow-down')
        </div>
    </div>
</section>
