<section>
    <div class="relative flex items-center justify-center py-16 pb-8 lg:min-h-[80vh] lg:pt-8">
        <div class="container mx-auto flex flex-col items-center gap-20 md:flex-row">
            <div class="flex flex-col gap-12 md:w-1/2 md:items-start md:text-left lg:grow">
                <div class="flex flex-col items-start gap-8">
                    <x-breadcrumb :links="[
                        'Application web Laravel' => route('laravel'),
                        'E-commerce sur mesure' => route('ecommerce'),
                    ]" />
                    <h1 class="font-title text-4xl font-bold text-white xl:text-5xl">
                        Création de site <span class="text-nowrap">e-commerce</span> sur mesure à <span class="whitespace-nowrap">Bordeaux</span>
                    </h1>
                </div>
                <div class="font-text flex flex-col gap-4">
                    <p>
                        Je développe votre boutique en ligne avec Laravel et Lunar : une plateforme qui vous
                        appartient, <span class="text-yellow">sans abonnement ni commission directe sur vos ventes</span>,
                        et qui évolue avec votre activité.
                    </p>
                    <p>
                        Votre code et vos données sont votre propriété, sans dépendance pour garder la
                        maîtrise de vos coûts et de votre <span class="text-yellow">souveraineté numérique</span>.
                    </p>
                </div>
                <div class="grid w-full gap-4 *:w-full lg:grid-cols-2">
                    <div class="lg:col-span-2">
                        <x-button.primary href="#contact" title="E-commerce : formulaire de contact" @click.prevent="scrollToTarget('#contact')">
                            Discutons de votre projet
                        </x-button.primary>
                    </div>
                </div>
            </div>
            <div class="hidden w-full justify-center *:h-auto *:w-full md:w-1/2 lg:flex *:lg:h-[65vh] *:lg:w-auto">
                <img src="{{ asset('img/illustrations/ecommerce.svg') }}" alt="" width="305" height="214" fetchpriority="high" />
            </div>
        </div>
    </div>
    @include('elements.reassurance')
</section>
