<div id="services" x-data="services" class="relative overflow-hidden bg-blue px-8 md:px-16 py-16 md:py-24">
    <img src="{{ asset('img/illustrations/services.svg') }}" class="absolute x-center y-center h-3/4 opacity-10" width="587" height="409" alt="Paquets" title="Arrière plan" loading="lazy" />
    <div class="container mx-auto">
        <h2 class="text-orange text-4xl mb-14 w-full text-center z-10">Mes services</h2>
        <div class="grid md:grid-cols-2 gap-12 z-10">
            <div>
                <h3 class="text-white text-xl mb-6">Techniques</h3>
                <ul class="text-white">
                    <li class="flex items-center mb-6 md:mb-4">
                        <img src="{{ asset('img/illustrations/check-rounded.svg') }}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                        <div>
                            Création de plateforme web sur-mesure avec le
                            <div class="mx-1 inline-block">  
                                <x-tooltip color="#001A9E">
                                    <x-slot:message>
                                        Boite à outils servant aux développeur à créer des sites sur-mesure
                                    </x-slot>
                                    <x-slot:content>
                                        <span class="flex hover:cursor-pointer">
                                            <i>framework</i> @include('elements.icons.question')
                                        </span>
                                    </x-slot>
                                </x-tooltip>
                            </div>
                            Laravel 
                        </div>
                    </li>
                    <li class="flex items-center mb-6 md:mb-4">
                        <img src="{{ asset('img/illustrations/check-rounded.svg') }}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                        <div>
                            Conception de site internet clé en main
                            <u class="ml-1">
                                <a href="#votre-projet" @click.prevent="scrollToTarget('#votre-projet')">Prestashop et Wordpress</a>
                            </u>
                        </div>
                    </li>
                    <li class="flex items-center mb-6 md:mb-4">
                        <img src="{{ asset('img/illustrations/check-rounded.svg') }}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                        <div>
                            Optimisation du référencement naturel 
                            <div class="mx-1 inline-block">
                                <x-tooltip color="#001A9E">
                                    <x-slot:message>
                                        Search Engine Optimization ou Optimisation pour les moteurs de recherche
                                    </x-slot>
                                    <x-slot:content>
                                        <span class="flex hover:cursor-pointer">
                                            (<i>SEO</i> @include('elements.icons.question'))
                                        </span>
                                    </x-slot>
                                </x-tooltip>
                            </div>
                        </div>
                    </li>
                    <li class="flex items-center mb-6 md:mb-4">
                        <img src="{{ asset('img/illustrations/check-rounded.svg') }}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                        Mise en ligne de site
                    </li>
                    <li class="flex items-center mb-6 md:mb-4">
                        <img src="{{ asset('img/illustrations/check-rounded.svg') }}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                        Support et maintenance
                    </li>
                </ul>
            </div>
            <div>
                <h3 class="text-white text-xl mb-6">Accompagnement et conseils</h3>
                <ul class="text-white">
                    <li class="flex items-center mb-6 md:mb-4">
                        <img src="{{ asset('img/illustrations/check-rounded.svg') }}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                        Analyse des besoins techniques en fonction des contraintes métiers
                    </li>
                    <li class="flex items-center mb-6 md:mb-4">
                        <img src="{{ asset('img/illustrations/check-rounded.svg') }}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                        <div>
                            Gestion de projet sur une base 
                            <div class="mx-1 inline-block">
                                <x-tooltip color="#001A9E">
                                    <x-slot:message>
                                        Méthode qui inclut le client tout au long du projet afin de valider au fur et à mesure
                                    </x-slot>
                                    <x-slot:content>
                                        <span class="flex hover:cursor-pointer">
                                            <i>Agile</i> @include('elements.icons.question')
                                        </span>
                                    </x-slot>
                                </x-tooltip>
                            </div>
                        </dvi>
                    </li>
                    <li class="flex items-center mb-6 md:mb-4">
                        <img src="{{ asset('img/illustrations/check-rounded.svg') }}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                        Estimation des coûts
                    </li>
                    <li class="flex items-center mb-6 md:mb-4">
                        <img src="{{ asset('img/illustrations/check-rounded.svg') }}" class="mr-3" width="25" height="25" alt="Illustration picto check" title="Check"/>
                        Formation à l'utilisation de la plateforme et des outils associés
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('alpine:init', () => {
        Alpine.data('services', () => ({
            scrollToTarget : function(target)
            {
              window.scrollTo({
                top: document.querySelector(target).offsetTop,
                left: 0,
                behavior: 'smooth'
              });
            }
        }))
    })
</script>
