<section id="quelle-utilisation" class="-mt-24 pt-24">
    <div class="container mx-auto">
        <div class="flex flex-col-reverse gap-16 sm:flex-row sm:gap-0">
            <div class="border-gray flex flex-col items-start justify-start gap-8 sm:w-3/4 sm:border-r sm:border-t-0 sm:py-8 sm:pr-8 sm:text-left md:py-16 md:pr-16">
                <div class="flex items-center gap-8">
                    <div class="*:w-12 *:h-auto">
                        @include('elements.icon.check-list')
                    </div>
                    <h2>
                        Quelles applications je développe avec Laravel ?
                    </h2>
                </div>
                <p class="text-md leading-relaxed">
                    Contrairement à des outils comme <a href="{{ route('webflow') }}" class="underline">Webflow</a>,
                    Prestashop ou WordPress, qui imposent une base standardisée, un framework permet de modeler votre
                    application selon vos besoins, avec plus de <b>flexibilité</b>, de <b>performance</b> et de
                    <b>sécurité</b>. Quelques exemples de projets :
                </p>
                <ul class="text-md flex list-disc flex-col gap-2 pl-6 leading-relaxed">
                    <li><b>CRM et outils de gestion sur mesure</b> : suivi des clients, devis, facturation, planning.</li>
                    <li><b>Outils internes et back-offices</b> : digitalisation de processus métier, tableaux de bord,
                        gestion des stocks ou des commandes.</li>
                    <li><b>Extranets et portails clients</b> : espaces sécurisés pour vos clients, partenaires ou
                        équipes.</li>
                    <li><b>API et connecteurs</b> : échanges avec votre ERP, votre CRM, une application mobile ou des
                        services tiers (paiement, logistique, emailing).</li>
                    <li><b>Plateformes SaaS et gestion d’abonnements</b> : comptes utilisateurs, rôles, paiement
                        récurrent.</li>
                    <li><b>E-commerce sur mesure</b> : lorsque les solutions standards atteignent leurs limites, voir
                        la <a href="{{ route('ecommerce') }}" class="underline">création de site e-commerce à
                            Bordeaux</a>.</li>
                </ul>
            </div>
            <div class="max-w-full sm:pl-8 sm:pt-8 md:w-1/4 md:pt-16 lg:px-12">
                <div class="sticky sm:top-24">
                    <div class="relative mx-8 md:mx-0">
                        <img src="{{ asset('img/logos/laravel.svg') }}" class="w-full bg-white p-5" alt="Logo Laravel" width="50" height="52">
                        <div data-element="line-horizontal" class="absolute left-1/2 top-0 h-[1px] w-[150%] -translate-x-1/2 bg-gradient-to-r">
                        </div>
                        <div data-element="line-horizontal" class="absolute bottom-0 left-1/2 h-[1px] w-[150%] -translate-x-1/2 bg-gradient-to-r">
                        </div>
                        <div data-element="line-vertical" class="absolute left-0 top-1/2 h-[150%] w-[1px] -translate-y-1/2 bg-gradient-to-b">
                        </div>
                        <div data-element="line-vertical" class="absolute right-0 top-1/2 h-[150%] w-[1px] -translate-y-1/2 bg-gradient-to-b">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
