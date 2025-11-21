<section id="opquast" class="pt-24 -mt-24">
    <div class="container mx-auto">
        <div class="flex flex-col-reverse gap-16 sm:gap-0 sm:flex-row ">
            <div
                class="flex flex-col items-start justify-start gap-8 border-gray sm:w-3/4 sm:pr-8 sm:py-8 md:pr-16 md:py-16 sm:border-r sm:border-t-0 sm:text-left">
                <div class="flex flex-row-reverse items-center gap-8 sm:flex-row">
                    <h2 class="text-3xl sm:text-4xl">
                        Quels avantages ?
                    </h2>
                    <div class="w-24 sm:w-12">
                        @include('elements.icon.check-list')
                    </div>
                </div>
                <p class="leading-relaxed text-md">
                    Lunar permet une maîtrise complète du fonctionnement d’un site e-commerce, là où Prestashop et
                    Shopify imposent des structures et des limites fonctionnelles.
                    Le code est totalement accessible, personnalisable et cohérent avec l’écosystème Laravel, ce qui
                    élimine la dépendance aux modules tiers et aux surcharges techniques fréquentes sur Prestashop.
                    Aucune contrainte d’abonnement, de commission ou de verrou propriétaire comme sur Shopify :
                    l’infrastructure, le paiement et les intégrations restent entièrement contrôlés.
                    <br /><br />
                    L’architecture de Lunar facilite les développements spécifiques, les modèles de pricing complexes,
                    les workflows métier, les synchronisations avec des outils internes et les catalogues non standard.
                    Les performances et la scalabilité dépendent uniquement de l’environnement Laravel, ce qui garantit
                    une montée en charge sans les limites imposées par les plateformes SaaS ou les CMS e-commerce
                    préconstruits.
                    <br /><br />
                    Lunar offre donc un socle e-commerce flexible, extensible et durable, adapté aux projets nécessitant
                    un haut niveau de personnalisation et une logique métier sur mesure.
                </p>
            </div>
            <div class="max-w-full sm:pl-8 lg:px-12 md:w-1/4 sm:pt-8 md:pt-16">
                <div class="sticky sm:top-24">
                    <div class="relative mx-8 md:mx-0">
                        <img src="{{ asset('img/logos/lunar.svg') }}" class="w-full p-5 bg-blue-dark" alt="Logo Lunar">
                        <div data-element="line-horizontal"
                            class="absolute h-[1px] left-1/2 w-[150%] -translate-x-1/2 top-0 bg-gradient-to-r  ">
                        </div>
                        <div data-element="line-horizontal"
                            class="absolute h-[1px] left-1/2 w-[150%] -translate-x-1/2 bottom-0 bg-gradient-to-r  ">
                        </div>
                        <div data-element="line-vertical"
                            class="absolute w-[1px] top-1/2 h-[150%] -translate-y-1/2 left-0 bg-gradient-to-b  ">
                        </div>
                        <div data-element="line-vertical"
                            class="absolute w-[1px] top-1/2 h-[150%] -translate-y-1/2 right-0 bg-gradient-to-b  ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
