<div id="offres" class="px-8 md:px-16 py-16 md:py-24 bg-blue-dark min-h-screen">
        <div class="grid grid-cols-3 gap-6 align-top justify-between ">
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
                    <ul class="flex justify-start flex-col px-4 py-8">
                        <li class="flex items-center mb-6 md:mb-4">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Technologie&nbsp;
                            <a target="_blank" href="https://webflow.com/" class="flex items-center gap-1">
                                Webflow
                                @include('elements.icons.external-link')
                            </a>
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Design personnalisable
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Édition du contenu (CMS)
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Prise en main simplifiée
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Site léger et rapide
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Hébergement intégré sécurisé
                        </li>
                        <li class="flex items-center mb-6 md:mb-4">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Optimisation&nbsp;
                            <x-tooltip color="#001A9E">
                                <x-slot:message>
                                    <div class="px-6 py-4 leading-4">
                                        Search Engine Optimization ou Optimisation pour les moteurs de recherche (Google)
                                    </div>
                                </x-slot>
                                <x-slot:content>
                                    <span class="flex hover:cursor-pointer">
                                        <i>SEO</i> @include('elements.icons.question')
                                    </span>
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
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            CMS&nbsp;
                            <a href="https://www.prestashop.com/fr" target="_blank" class="flex items-center gap-1">
                                Prestashop
                                @include('elements.icons.external-link')
                            </a>
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Aucun frais de transaction
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Gestion des produits et des commandes clé-en-main
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            <div>
                                Processus de commande en 3 étapes<br/>ou 
                                <div class="mx-1 inline-block">  
                                    <x-tooltip color="#001A9E">
                                        <x-slot:message>
                                            <div class="px-6 py-4 leading-4">
                                                L'ensemble du processus de commande (information client, choix du transporter et du mode de paiement) se fait sur une seule page
                                            </div>
                                        </x-slot>
                                        <x-slot:content>
                                            <span class="flex hover:cursor-pointer">
                                                <i>OnePage Checkout</i> @include('elements.icons.question')
                                            </span>
                                        </x-slot>
                                    </x-tooltip>
                                </div>
                            </div>
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Interface d'administration intégrée
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Catalogue de thèmes et d'extensions mis à jour régulièrement
                        </li>
                    </ul>
                </div>
                <div class="absolute bottom-8 left-0 w-full text-center">
                    <a href="#" class="inline-block bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 md:mb-0">
                        En savoir plus
                    </a>
                </div>
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
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            <div class="mr-1 inline-block">  
                                <x-tooltip color="#001A9E">
                                    <x-slot:message>
                                        <div class="px-6 py-4 leading-4">
                                            Boite à outils servant aux développeurs à créer des sites sur-mesure
                                        </div>
                                    </x-slot>
                                    <x-slot:content>
                                        <span class="flex hover:cursor-pointer">
                                        <i>Framework</i> @include('elements.icons.question')
                                        </span>
                                    </x-slot>
                                </x-tooltip>
                            </div> 
                            Laravel
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Digitalisation de vos processus métier
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Architecture robuste et sécurisée
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Performances accrues
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            <div class="mx-1 inline-block">  
                                <x-tooltip color="#001A9E">
                                    <x-slot:message>
                                        <div class="px-6 py-4 leading-4">
                                            Terme désignant une application conçue pour être extensible et répondre à des besoins spécifiques.
                                        </div>
                                    </x-slot>
                                    <x-slot:content>
                                        <span class="flex hover:cursor-pointer">
                                            <i>Scalable</i> @include('elements.icons.question')
                                        </span>
                                    </x-slot>
                                </x-tooltip>
                            </div>
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Écosystème poussé
                        </li>
                        <li class="flex items-center mb-6 md:mb-4 text-left leading-5">
                            <img src="{{ asset('img/illustrations/check.svg')}}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                            Mises à jour régulières de la technologie
                        </li>
                    </ul>
                </div>
                <div class="absolute bottom-8 left-0 w-full text-center">
                    <a href="#" class="inline-block bg-blue hover:bg-blue-dark text-white px-6 py-3 rounded shadow-md mb-4 md:mb-0">
                        En savoir plus
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
