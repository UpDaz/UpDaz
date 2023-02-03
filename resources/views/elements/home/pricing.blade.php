<div id="offres" class="px-8 md:px-16 py-16 md:py-24 bg-blue-dark min-h-screen">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 align-top justify-center md:justify-between ">
            <div class="bg-blue">
                <div class="relative text-center bg-white border-orange border-8 px-4 py-8 h-full w-full mt-2 ml-2">
                    <h2 class="text-blue text-xl">
                        Landing page
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
                            @include('elements.svg-icons.check')
                                Technologie&nbsp;
                                <a target="_blank" href="https://webflow.com/" class="flex items-center gap-1 border-b-2">
                                    Webflow
                                    @include('elements.svg-icons.external-link')
                                </a>
                            </li>
                            <li class="flex items-center mb-6 md:mb-4">
                            @include('elements.svg-icons.check')
                                Design personnalisable
                            </li>
                            <li class="flex items-center mb-6 md:mb-4">
                            @include('elements.svg-icons.check')
                                Édition du contenu (CMS)
                            </li>
                            <li class="flex items-center mb-6 md:mb-4">
                            @include('elements.svg-icons.check')
                                Prise en main simplifiée
                            </li>
                            <li class="flex items-center mb-6 md:mb-4">
                            @include('elements.svg-icons.check')
                                Site léger et rapide
                            </li>
                            <li class="flex items-center mb-6 md:mb-4">
                            @include('elements.svg-icons.check')
                                Hébergement intégré sécurisé
                            </li>
                            <li class="flex items-center mb-6 md:mb-4">
                            @include('elements.svg-icons.check')
                                Optimisation&nbsp;
                                <x-tooltip color="#001A9E">
                                    <x-slot:message>
                                        <span class="block p-6">
                                            Search Engine Optimization ou Optimisation pour les moteurs de recherche (Google)
                                        </span>
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
            </div>
            <div class="bg-blue">
                <div class="relative text-center bg-white border-orange border-8 px-4 py-8 h-full w-full mt-2 ml-2">
                    <h2 class="text-blue text-xl">
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
                            @include('elements.svg-icons.check')
                                CMS&nbsp;
                                <a href="https://www.prestashop.com/fr" target="_blank" class="flex items-center gap-1 border-b-2">
                                    Prestashop
                                    @include('elements.svg-icons.external-link')
                                </a>
                            </li>
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                Aucun frais de transaction
                            </li>
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                Gestion des produits et des commandes clé-en-main
                            </li>
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                <div>
                                    Processus de commande en 3 étapes<br/>ou 
                                    <x-tooltip color="#001A9E">
                                        <x-slot:message>
                                            <span class="block p-6">
                                                L'ensemble du processus de commande (information client, choix du transporter et du mode de paiement) se fait sur une seule page
                                            </span>        
                                        </x-slot>
                                        <x-slot:content>
                                            <i>OnePage Checkout</i>
                                        </x-slot>
                                    </x-tooltip>
                                </div>
                            </li>
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                Interface d'administration intégrée
                            </li>
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                Catalogue de thèmes et d'extensions mis à jour régulièrement
                            </li>
                        </ul>
                    </div>
                    <div class="absolute bottom-8 left-0 w-full text-center">
                        <a href="{{ route('prestashop') }}" class="inline-block bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 md:mb-0">
                            En savoir plus
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-blue">
                <div class="relative text-center bg-white border-orange border-8 px-4 py-8 h-full w-full mt-2 ml-2">
                    <h2 class="text-blue text-xl">
                        Application métier
                        <br/>
                        & Sur-mesure
                    </h2>
                    <h3 class="text-4xl font-bold text-blue mt-10 mb-2">
                        Sur devis
                    </h3>
                    <div class="flex justify-center mb-8">
                        <ul class="flex justify-start flex-col px-4 py-8">
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                <x-tooltip color="#001A9E">
                                    <x-slot:message>
                                        <span class="block p-6">
                                            Boite à outils servant aux développeurs à créer des sites sur-mesure
                                        </span>
                                    </x-slot>
                                    <x-slot:content>
                                        <i>Framework</i>
                                    </x-slot>
                                </x-tooltip>
                                Laravel
                            </li>
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                Digitalisation de vos processus métier
                            </li>
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                Architecture robuste et sécurisée
                            </li>
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                Performances accrues
                            </li>
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                <x-tooltip color="#001A9E">
                                <x-slot:message>
                                    <span class="block p-6">
                                        Terme désignant une application conçue pour être extensible et répondre à des besoins spécifiques.
                                    </span>
                                </x-slot>
                                <x-slot:content>
                                    <i>Scalable</i>
                                </x-slot>
                            </x-tooltip>
                            </li>
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                Écosystème poussé
                            </li>
                            <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            @include('elements.svg-icons.check')
                                Mises à jour régulières de la technologie
                            </li>
                        </ul>
                    </div>
                    <div class="absolute bottom-8 left-0 w-full text-center">
                        <a href="{{ route('laravel') }}" class="inline-block bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 md:mb-0">
                            En savoir plus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
