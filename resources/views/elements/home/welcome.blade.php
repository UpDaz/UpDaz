<section class="flex items-center justify-center min-h-[100vh] relative md:-mt-24 pt-8 md:pt-24">
    <div class="container flex flex-col items-center gap-16 mx-auto md:flex-row">
        <div class="flex flex-col gap-12 lg:flex-grow md:w-1/2 md:items-start md:text-left">
            <div class="flex items-center gap-8 md:block">
                <div class="w-16 md:mb-6">
                    @include('elements.icon.www')
                </div>
                <h1 class="text-4xl font-bold text-white font-title md:text-5xl txt-rotate">
                    Artisan du web
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
                <div class="xl:col-span-3">
                    <x-button.primary href="#contact" title="UpDaz : formulaire de contact"
                        @click.prevent="scrollToTarget('#contact')" classes="lg:col-span-2 xl:col-span-3">
                        Me contacter
                    </x-button-primary>
                </div>
            </div>
        </div>
        <div class="flex justify-center w-full md:w-1/2 *:w-auto *:lg:h-[65vh]">
            @include('elements.home.welcome-illustration')
        </div>
    </div>
    <div class="absolute w-8 -translate-x-1/2 bottom-4 left-1/2">
            @include('elements.icon.arrow-down-square')
        </div>
</section>
