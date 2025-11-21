<section id="opquast" class="pt-24 -mt-24">
    <div class="container mx-auto">
        <div class="flex flex-col-reverse gap-16 sm:gap-0 sm:flex-row ">
            <div
                class="flex flex-col items-start justify-start gap-8 border-gray sm:w-3/4 sm:pr-8 sm:py-8 md:pr-16 md:py-16 sm:border-r sm:border-t-0 sm:text-left">
                <div class="flex flex-row-reverse items-center gap-8 sm:flex-row">
                    <h2 class="text-3xl sm:text-4xl">
                        Quelle utilisation ?
                    </h2>
                    <div class="w-24 sm:w-12">
                        @include('elements.icon.check-list')
                    </div>
                </div>
                <p class="leading-relaxed text-md">
                    L’intérêt d’utiliser un framework comme base est de pouvoir modeler votre application web en
                    fonction de vos besoins.<br/>
                    Des outils comme <a href="{{ route('webflow') }}">Webflow</a>, Prestashop ou Wordpress offrent une expérience formatée et vous impose une
                    base standardisée (aussi bien pour l’affichage du site que pour son fonctionnement) demandant
                    d’importantes ressources pour s’adapter aux spécificités métiers.<br/>
                    Un framework permet de gagner en <b>flexibilité</b>, en spécialisation et en <b>performance</b> tout en garantissant une <b>sécurité importante</b>.
                    <br /><br />
                    Les possibilités sont donc “infinies” et vont des plus classiques aux plus spécifiques :
                    landing page, site vitrine, boutique en ligne, e-learning, CRM, annuaires en ligne, API, gestion
                    d’abonnements, extranet, …
                </p>
            </div>
            <div class="max-w-full sm:pl-8 lg:px-12 md:w-1/4 sm:pt-8 md:pt-16">
                <div class="sticky sm:top-24">
                    <div class="relative mx-8 md:mx-0">
                        <img src="{{ asset('img/logos/laravel.svg') }}" class="w-full p-5 bg-white" alt="Logo Laravel">
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
