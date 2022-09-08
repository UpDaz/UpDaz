<div id="offres" class="px-8 md:px-16 py-16 md:py-24 bg-blue-dark min-h-screen">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 align-top justify-center md:justify-between ">
            <div class="relative w-full text-center bg-white border-orange border-8 px-4 py-8">
                <h2 class="text-orange text-xl">
                    Landing-page
                    <br/>
                    & site vitrine
                </h2>
                <p class="text-xs mt-8 text-grey-500">
                    À partir de
                </p>
                <h3 class="text-4xl font-bold text-blue m-0">
                    1 000€
                </h3>
                <div class="flex justify-center mb-8">
                    <ul class="flex justify-start flex-col px-4 py-8 text-left">
                        <li class="flex items-center mb-6 md:mb-4">
                           @include('elements.icons.check')
                            Technologie&nbsp;
                            <a target="_blank" href="https://webflow.com/" class="flex items-center gap-1">
                                Webflow
                                @include('elements.icons.external-link')
                            </a>
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                           @include('elements.icons.check')
                            Design personnalisable
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                           @include('elements.icons.check')
                            Édition du contenu (CMS)
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                           @include('elements.icons.check')
                            Prise en main simplifiée
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                           @include('elements.icons.check')
                            Site léger et rapide
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                           @include('elements.icons.check')
                            Hébergement intégré sécurisé
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                           @include('elements.icons.check')
                            Optimisation&nbsp;
                            <x-tooltip color="#001A9E">
                                <x-slot:message>
                                    Search Engine Optimization ou Optimisation pour les moteurs de recherche (Google)
                                </x-slot>
                                <x-slot:content>
                                    <i>SEO</i>
                                </x-slot>
                            </x-tooltip>
                        </li>
                    </ul>
                </div>
                <div class="absolute bottom-8 left-0 w-full text-center">
                    <a href="{{ route('webflow') }}" class="inline-block bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 md:mb-0">
                        En savoir plus
                    </a>
                </div>
            </div>
            <div class="relative w-full text-center bg-white border-orange border-8 px-4 py-8">
                <h2 class="text-orange text-xl">
                    E-commerce & 
                    <br/>
                    Boutique en ligne
                </h2>
                <p class="text-xs mt-8 text-grey-500">
                    À partir de
                </p>
                <h3 class="text-4xl font-bold text-blue m-0">
                    2 500€
                </h3>
                <div class="flex justify-center mb-8">
                    <ul class="flex justify-start flex-col px-4 py-8">
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            CMS&nbsp;
                            <a href="https://www.prestashop.com/fr" target="_blank" class="flex items-center gap-1">
                                Prestashop
                                @include('elements.icons.external-link')
                            </a>
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            Aucun frais de transaction
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            Gestion des produits et des commandes clé-en-main
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            <div>
                                Processus de commande en 3 étapes<br/>ou 
                                <x-tooltip color="#001A9E">
                                    <x-slot:message>
                                        L'ensemble du processus de commande (information client, choix du transporter et du mode de paiement) se fait sur une seule page
                                    </x-slot>
                                    <x-slot:content>
                                        <i>OnePage Checkout</i>
                                    </x-slot>
                                </x-tooltip>
                            </div>
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            Interface d'administration intégrée
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            Catalogue de thèmes et d'extensions mis à jour régulièrement
                        </li>
                    </ul>
                </div>
                @if (false)
                <div class="absolute bottom-8 left-0 w-full text-center">
                    <a href="#" class="inline-block bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 md:mb-0">
                        En savoir plus
                    </a>
                </div>
                @endif
            </div>
            <div class="relative w-full text-center bg-white border-orange border-8 px-4 py-8">
                <h2 class="text-orange text-xl">
                    Application métier
                    <br/>
                    & Sur-mesure
                </h2>
                <h3 class="text-4xl font-bold text-blue mt-10 mb-2">
                    Sur demande
                </h3>
                <div class="flex justify-center mb-8">
                    <ul class="flex justify-start flex-col px-4 py-8">
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            <x-tooltip color="#001A9E">
                                <x-slot:message>
                                    Boite à outils servant aux développeurs à créer des sites sur-mesure
                                </x-slot>
                                <x-slot:content>
                                    <i>Framework</i>
                                </x-slot>
                            </x-tooltip>
                            Laravel
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            Digitalisation de vos processus métier
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            Architecture robuste et sécurisée
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            Performances accrues
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            <x-tooltip color="#001A9E">
                            <x-slot:message>
                                Terme désignant une application conçue pour être extensible et répondre à des besoins spécifiques.
                            </x-slot>
                            <x-slot:content>
                                <i>Scalable</i>
                            </x-slot>
                        </x-tooltip>
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            Écosystème poussé
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                           @include('elements.icons.check')
                            Mises à jour régulières de la technologie
                        </li>
                    </ul>
                </div>
                @if (false)
                <div class="absolute bottom-8 left-0 w-full text-center">
                    <a href="#" class="inline-block bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 md:mb-0">
                        En savoir plus
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
