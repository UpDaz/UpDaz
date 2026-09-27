<section>
    <div class="relative flex items-center justify-center py-16 pb-8 lg:min-h-[80vh] lg:pt-8">
        <div class="container mx-auto flex flex-col items-center gap-20 md:flex-row">
            <div class="flex flex-col gap-12 lg:w-1/2 md:items-start md:text-left lg:grow">
                <h1 class="font-title text-4xl font-bold text-white xl:text-5xl">
                    Développeur Laravel à <span class="whitespace-nowrap">Bordeaux :</span> applications web sur mesure
                </h1>
                <div class="font-text flex flex-col gap-4">
                    <p>
                        Développeur Laravel freelance à Bordeaux depuis plus de 10 ans, je conçois des
                        <span class="text-yellow">applications web métier sur mesure</span> : CRM, outils internes,
                        extranets, API et e-commerce.
                    </p>
                    <p>
                        Du cadrage à la mise en ligne, puis en maintenance, je vous accompagne pour une application
                        <span class="text-yellow">performante, durable et sécurisée</span>, à Bordeaux, en Gironde ou
                        à distance partout en France.
                    </p>
                </div>
                <x-button.primary href="#contact" title="Laravel : formulaire de contact" @click.prevent="scrollToTarget('#contact')" classes="lg:col-span-2 xl:col-span-3">
                    Votre application web Laravel
                    </x-button-primary>

            </div>
            <div class="hidden w-full justify-center *:h-auto *:w-full md:w-1/2 lg:flex *:lg:h-[65vh] *:lg:w-auto">
                <img src="{{ asset('img/illustrations/laravel.svg') }}" alt="" width="292" height="275" loading="lazy" />
            </div>
        </div>
    </div>
    @include('elements.reassurance')
</section>
