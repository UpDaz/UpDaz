<section>
    <div class="flex items-center justify-center relative py-16 pb-8 lg:pt-8 lg:min-h-[80vh]">
        <div class="container flex flex-col items-center gap-20 mx-auto md:flex-row">
            <div class="flex flex-col gap-12 lg:grow md:w-1/2 md:items-start md:text-left">
                <h1 class="text-4xl xl:text-5xl font-bold text-white font-title">
                    Création de site e-commerce à Bordeaux
                </h1>
                <p class="font-text">
                    UpDaz vous accompagne pour concevoir un site e-commerce, générer des ventes et optimiser votre
                    boutique en ligne <span class="text-yellow">performante</span> et
                    <span class="text-yellow">sécurisée</span>, à Bordeaux ou à distance.
                </p>
                <div class="grid *:w-full gap-4 lg:grid-cols-2 w-full">
                    <x-button.secondary href="#presentation" @click.prevent="scrollToTarget('#presentation')"
                        title="Présentation e-commerce">
                        En savoir plus
                    </x-button.secondary>
                    <x-button.secondary href="#accompagnement" @click.prevent="scrollToTarget('#accompagnement')"
                        title="Accompagnement e-commerce">
                        Mon accompagnement
                    </x-button.secondary>
                    <div class="xl:col-span-3">
                        <x-button.primary href="#contact" title="E-commerce : formulaire de contact"
                            @click.prevent="scrollToTarget('#contact')" classes="lg:col-span-2 xl:col-span-3">
                            Discutons de votre projet
                            </x-button-primary>
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex justify-center w-full *:w-full *:h-auto md:w-1/2 *:lg:w-auto *:lg:h-[65vh]">
                <img src="{{ asset('img/illustrations/ecommerce.svg') }}" alt="" width="305" height="214" fetchpriority="high" />
            </div>
        </div>
    </div>
    @include('elements.reassurance')
</section>
