<section class="flex items-center justify-center min-h-[100vh] relative md:-mt-24 pt-8 md:pt-24">
    <div class="container flex flex-col items-center gap-20 mx-auto md:flex-row">
        <div class="flex flex-col gap-12 lg:flex-grow md:w-1/2 md:items-start md:text-left">
            <div class="flex items-center gap-8 md:block">
                <h1 class="text-5xl font-bold text-white font-title txt-rotate">
                    Création de site e-commerce à Bordeaux
                </h1>
            </div>
            <p class="font-text">
                UpDaz vous accompagne pour concevoir un site e-commerce, générer des ventes et optimiser votre boutique en ligne <span class="text-yellow">performant</b>, et <span class="text-yellow">sécurisé</span>.
            </p>
            <div class="grid *:w-full gap-4 lg:grid-cols-2 w-full">
                <x-button.secondary href="#presentation" @click.prevent="scrollToTarget('#presentation')"
                    title="Présentation Laravel">
                    En savoir plus
                </x-button.secondary>
                <x-button.secondary href="#accompagnement" @click.prevent="scrollToTarget('#accompagnement')" title="Accompagnement Laravel">
                    Mon accompagnement
                </x-button.secondary>
                <div class="xl:col-span-3">
                    <x-button.primary href="#contact" title="Laravel : formulaire de contact"
                        @click.prevent="scrollToTarget('#contact')" classes="lg:col-span-2 xl:col-span-3">
                        Discutons de votre projet
                    </x-button-primary>
                </div>
            </div>
        </div>
        <div class="flex justify-center w-full *:w-full *:h-auto md:w-1/2 *:lg:w-auto *:lg:h-[65vh]">
            @include('elements.ecommerce.hero-illustration')
        </div>
    </div>
    <div class="absolute hidden w-8 -translate-x-1/2 md:block bottom-4 left-1/2">
        <a href="#presentation" @click.prevent="scrollToTarget('#presentation')">
            @include('elements.icon.arrow-down-square')
        </a>
    </div>
</section>
