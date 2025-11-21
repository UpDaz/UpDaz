<section id="offres" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <h2 class="w-full mx-auto text-3xl text-center sm:text-4xl">À chaque besoin son offre</h2>
        <div class="grid md:grid-cols-3">
            <x-price>
                <x-slot:title>
                    <h3 class="text-white text-md title-font">Site vitrine</h3>
                    <h4 class="pb-4 mb-4 text-4xl leading-none text-yellow">
                        <span>CMS</span>
                    </h4>
                </x-slot:title>
                <div class="flex flex-col gap-2">
                    <x-skills.item text="Design personnalisable" />
                    <x-skills.item text="Édition du contenu (CMS)" />
                    <x-skills.item text="Site moderne et performant" />
                    <x-skills.item text="Hébergement intégré sécurisé" />
                    <x-skills.item text="Optimisations SEO" />
                </div>
                <div class="mt-8">
                    <x-button.secondary href="{{ route('webflow') }}" title="Lien page Webflow">
                        En savoir plus sur Webflow
                    </x-button.secondary>
                </div>
            </x-price>

            <div class="relative">
                <x-price>
                    <x-slot:title>
                        <h3 class="text-white text-md title-font">Application web</h3>
                        <h4 class="pb-4 mb-4 text-4xl leading-none text-yellow">
                            <span>sur-mesure</span>
                        </h4>
                    </x-slot:title>
                    <div class="flex flex-col gap-2">
                        <x-skills.item text="Digitalisation de vos processus métier" />
                        <x-skills.item text="Architecture robuste et sécurisée" />
                        <x-skills.item text="Performances accrues" />
                        <x-skills.item text="Scalable - Montée en puissance" />
                        <x-skills.item text="Écosystème poussé" />
                        <x-skills.item text="Mises à jour régulières de la technologie" />
                    </div>
                    <div class="mt-8">
                        <x-button.primary href="{{ route('laravel') }}" title="Lien page Laravel">
                            En savoir plus<br />sur le sur-mesure
                        </x-button.primary>
                    </div>
                </x-price>
                <div class="hidden md:block">
                    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 left-0"></div>
                    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 right-0"></div>
                </div>
                <div class="md:hidden">
                    <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 top-0"></div>
                    <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 bottom-0"></div>
                </div>
            </div>

            <x-price>
                <x-slot:title>
                    <h3 class="mb-2 text-white text-md title-font">Site e-commerce</h3>
                    <h4 class="pb-4 mb-4 text-4xl leading-none text-yellow">
                        <span>boutique en ligne</span>
                    </h4>
                </x-slot:title>
                <div class="flex flex-col gap-2">
                    <x-skills.item text="Application sur-mesure e-commerce grace à l'extension Lunar" />
                    <x-skills.item text="Aucun frais de transaction sur les ventes" />
                    <x-skills.item text="Gestion des produits et des commandes via un panneau d'administration" />
                    <x-skills.item text="Tunnel de commande optimisé pour convertir le visiteur en client" />
                    <x-skills.item text="Interface d'administration adaptable" />
                </div>
                <div class="mt-8">
                    <x-button.secondary href="{{ route('ecommerce') }}" title="Lien page Laravel section Lunar">
                        En savoir plus sur le <span class="text-nowrap">e-commerce</span>
                    </x-button.secondary>
                </div>
            </x-price>
        </div>
    </div>
</section>
