<section id="offres" class="px-8 py-4 border-gray-200 md:px-16 md:py-16 bg-pattern-2 sm:border-y">
    <div class="container mx-auto">
      <div class="flex flex-col w-full mb-6 md:text-center md:mb-10">
        <h2 class="text-3xl font-medium text-black sm:text-4xl title-font">Offres</h2>
        <div class="w-20 h-1 my-2 ml-0 rounded md:mx-auto bg-blue"></div>
      </div>
      <div class="flex flex-wrap -m-4">

        <div class="w-full p-4 xl:w-1/3 md:w-1/2">
          <div class="relative flex flex-col h-full p-6 bg-white border-2 border-gray-300 rounded-lg">
            <h3 class="mb-2 text-md title-font text-blue">Landing page & site vitrine</h3>
            <h4 class="pb-4 mb-4 text-4xl leading-none text-black border-b border-gray-200">
                <span class="text-xs text-black">à partir de</span>
                <span>1000€</span>
            </h4>
            <p class="flex items-center mb-4">
              @include('elements.svg-icons.small-check')
              Technologie&nbsp;
                <a target="_blank" href="https://webflow.com/" class="flex items-center gap-1 border-b-2">
                    Webflow
                    @include('elements.svg-icons.external-link')
                </a>
            </p>
            <p class="flex items-center mb-4">
              @include('elements.svg-icons.small-check')
              Design personnalisable
            </p>
            <p class="flex items-center mb-4">
              @include('elements.svg-icons.small-check')
              Édition du contenu (CMS)
            </p>
            <p class="flex items-center mb-4">
                @include('elements.svg-icons.small-check')
                Site moderne et performant
            </p>
            <p class="flex items-center mb-4">
                @include('elements.svg-icons.small-check')
                Hébergement intégré sécurisé
            </p>
            <p class="flex items-center mb-4">
                @include('elements.svg-icons.small-check')
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
            </p>
            <a href="{{ route('webflow') }}" class="inline-block px-6 py-3 mt-6 font-medium text-center text-white rounded shadow-md bg-gradient-to-br hover:bg-gradient-to-r from-blue-dark to-blue hover:bg-orange">
                En savoir plus sur Webflow
            </a>
          </div>
        </div>

        <div class="w-full p-4 xl:w-1/3 md:w-1/2">
            <div class="relative flex flex-col h-full p-6 bg-white border-2 rounded-lg border-orange">
              <span class="absolute top-0 right-0 px-3 py-1 text-xs tracking-widest text-white uppercase rounded-bl bg-orange">best choice</span>
              <h3 class="mb-2 text-md title-font text-blue">Application métier & Sur-mesure</h3>
                <h4 class="pb-4 mb-4 text-4xl leading-none text-black border-b border-gray-200">
                    <span class="">sur devis</span>
                </h4>
              <p class="flex mb-4 items-cente">
                @include('elements.svg-icons.small-check')
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
              </p>
              <p class="flex items-center mb-4">
                @include('elements.svg-icons.small-check')
                Digitalisation de vos processus métier
              </p>
              <p class="flex items-center mb-4">
                @include('elements.svg-icons.small-check')
                Architecture robuste et sécurisée
              </p>
              <p class="flex items-center mb-4">
                @include('elements.svg-icons.small-check')
                Performances accrues
              </p>
              <p class="flex items-center mb-4">
                @include('elements.svg-icons.small-check')
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
              </p>
              <p class="flex items-center mb-4">
                @include('elements.svg-icons.small-check')
                Écosystème poussé
              </p>
              <p class="flex items-center mb-4">
                @include('elements.svg-icons.small-check')
                Mises à jour régulières de la technologie
              </p>
              <a href="{{ route('laravel') }}" class="inline-block px-6 py-3 mt-6 font-medium text-center text-white rounded shadow-md bg-gradient-to-br hover:bg-gradient-to-r from-blue-dark to-blue">
                En savoir plus sur<br/>le sur-mesure
            </a>
            </div>
          </div>

        <div class="w-full p-4 xl:w-1/3 md:w-1/2">
            <div class="relative flex flex-col h-full p-6 bg-white border-2 border-gray-300 rounded-lg">
              <h3 class="mb-2 text-md title-font text-blue">E-commerce & Boutique en ligne</h3>
              <h4 class="pb-4 mb-4 text-4xl leading-none text-black border-b border-gray-200">
                  <span class="text-xs text-black">à partir de</span>
                  <span>2500€</span>
              </h4>
              <p class="flex items-center mb-4 text-black">
                @include('elements.svg-icons.small-check')
                CMS&nbsp;
                <a href="https://www.prestashop.com/fr" target="_blank" class="flex items-center gap-1 border-b-2">
                    Prestashop
                    @include('elements.svg-icons.external-link')
                </a>
              </p>
              <p class="flex items-center mb-4">
                @include('elements.svg-icons.small-check')
                Aucun frais de transaction sur les ventes
              </p>
              <p class="flex items-center mb-4">
                @include('elements.svg-icons.small-check')
                Gestion des produits et des commandes clé-en-main
              </p>
              <p class="flex items-center mb-4">
                  @include('elements.svg-icons.small-check')
                  <span>
                    Processus de commande en 3 étapes ou 
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
                  </span>
              </p>
              <p class="flex items-center mb-4">
                  @include('elements.svg-icons.small-check')
                  Interface d'administration intégrée
              </p>
              <p class="flex items-center mb-4">
                  @include('elements.svg-icons.small-check')
                  Catalogue de thèmes et d'extensions mis à jour régulièrement
              </p>
              <a href="{{ route('prestashop') }}" class="inline-block px-6 py-3 mt-6 font-medium text-center text-white rounded shadow-md bg-gradient-to-br hover:bg-gradient-to-r from-blue-dark to-blue">
                  En savoir plus sur Prestashop
              </a>
            </div>
          </div>

      </div>
    </div>
  </section>
