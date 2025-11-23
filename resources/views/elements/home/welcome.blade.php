<section class="flex items-center justify-center min-h-[100vh] relative md:-mt-24 pt-8 md:pt-24">
    <div class="container flex flex-col items-center gap-20 mx-auto md:flex-row">
        <div class="flex flex-col gap-12 lg:flex-grow md:w-1/2 md:items-start md:text-left">
            <div class="flex items-center gap-8 md:block">
                <h1 class="text-5xl font-bold text-white font-title txt-rotate">
                    Artisan du web
                </h1>
            </div>
            <h2 class="font-text">Développeur d'<span class="text-yellow">application web sur-mesure</span>, <span class="text-yellow">e-commerce</span> et
                <span class="text-yellow">CMS</span> sur Bordeaux
            </h2>
            <div class="grid *:w-full gap-4 xl:grid-cols-3 w-full items-start">
                <x-button.secondary href="#presentation" @click.prevent="scrollToTarget('#presentation')"
                    title="Présentation UpDaz">
                    Qui <span class="text-nowrap">suis-je ?</span>
                </x-button.secondary>
                <x-button.secondary href="#competences" @click.prevent="scrollToTarget('#competences')"
                    title="Compétences et savoir-faire">
                    Compétences
                </x-button.secondary>
                <x-button.secondary href="#offres" @click.prevent="scrollToTarget('#offres')" title="Offres">
                    Offres
                </x-button.secondary>
                <div class="flex flex-col gap-4 lg:col-span-3">
                    <x-button.secondary href="{{ route('laravel') }}" title="Lien page sur-mesure">
                        Application web sur-mesure
                    </x-button.secondary>
                    <x-button.secondary href="{{ route('ecommerce') }}"  title="Lien page e-commerce">
                        Boutique en ligne et <span class="text-nowrap">e-commerce</span>
                    </x-button.secondary>
                    <x-button.secondary href="{{ route('webflow') }}" title="Lien page Webflow">
                        Site CMS
                    </x-button.secondary>
                    <x-button.primary href="#contact" title="UpDaz : formulaire de contact"
                        @click.prevent="scrollToTarget('#contact')" classes="lg:col-span-2 xl:col-span-3">
                        Me contacter
                        </x-button-primary>
                </div>
            </div>
        </div>
        <div class="flex justify-center w-full *:w-full *:h-auto md:w-1/2 *:lg:w-auto *:lg:h-[65vh]">
            @include('elements.home.welcome-illustration')
        </div>
    </div>
    <div class="absolute hidden w-8 -translate-x-1/2 md:block bottom-4 left-1/2">
        <a href="#presentation" @click.prevent="scrollToTarget('#presentation')">
            @include('elements.icon.arrow-down-square')
        </a>
    </div>
</section>
