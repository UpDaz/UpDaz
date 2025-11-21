<section class="flex items-center justify-center min-h-[100vh] relative md:-mt-24 pt-8 md:pt-24">
    <div class="container flex flex-col items-center gap-20 mx-auto md:flex-row">
        <div class="flex flex-col gap-12 lg:flex-grow md:w-1/2 md:items-start md:text-left">
            <div class="flex items-center gap-8 md:block">
                <h1 class="text-4xl font-bold text-white font-title md:text-5xl txt-rotate">
                    Création de site sur-mesure à Bordeaux
                </h1>
            </div>
            <h2 class="font-text">
                UpDaz vous accompagne pour concevoir un site sur-mesure, adapté à vos besoins et à vos contraintes métier, <span class="text-yellow">performant, durable et sécurisé</span>.
            </h2>
            <div class="grid *:w-full gap-4 lg:grid-cols-2 w-full">
                <x-button.secondary href="#presentation" @click.prevent="scrollToTarget('#presentation')"
                    title="Présentation Laravel">
                   À propos de Laravel
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
        <div class="flex justify-center w-full md:w-1/2 *:w-auto *:lg:h-[65vh]">
            @include('elements.laravel.hero-illustration')
        </div>
    </div>
    <div class="absolute w-8 -translate-x-1/2 bottom-4 left-1/2">
        <a href="#presentation" @click.prevent="scrollToTarget('#presentation')">
            @include('elements.icon.arrow-down-square')
        </a>
    </div>
</section>
