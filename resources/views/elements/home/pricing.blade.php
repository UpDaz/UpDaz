<section id="offres">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <h2 class="w-full mx-auto text-3xl text-center sm:text-4xl">Des offres adaptées à chaque besoin</h2>
        <div class="grid grid-cols-3">
            <x-price>
                <x-slot:title>
                    <h3 class="text-white text-md title-font">Landing page &</h3>
                    <h4 class="pb-4 mb-4 text-4xl leading-none text-yellow">
                        <span>site vitrine</span>
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
                    <x-button.secondary href="{{ route('webflow') }}">
                        En savoir plus sur Webflow
                    </x-button.secondary>
                </div>
            </x-price>

            <div class="relative">
                <x-price>
                    <x-slot:title>
                        <span class="absolute flex items-center gap-2 text-xs tracking-widest uppercase top-2 right-4 text-yellow">
                            <span class="*:w-6">@include('elements.icon.check')</span>
                            Meilleur choix
                        </span>
                        <h3 class="text-white text-md title-font">Application métier &</h3>
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
                        <x-button.primary href="{{ route('laravel') }}">
                            En savoir plus<br />sur le sur-mesure
                        </x-button.primary>
                    </div>
                </x-price>
                <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 left-0"></div>
                <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 right-0"></div>
            </div>

            <x-price>
                <x-slot:title>
                    <h3 class="mb-2 text-white text-md title-font">E-commerce &</h3>
                    <h4 class="pb-4 mb-4 text-4xl leading-none text-yellow">
                        <span>boutique en ligne</span>
                    </h4>
                </x-slot:title>
                <div class="flex flex-col gap-2">
                    <x-skills.item text="CMS Prestashop" />
                    <x-skills.item text="Aucun frais de transaction sur les ventes" />
                    <x-skills.item text="Gestion des produits et des commandes clé-en-main" />
                    <x-skills.item text="Processus de commande en 3 étapes ou OnePage Checkout" />
                    <x-skills.item text="Interface d'administration intégrée" />
                    <x-skills.item text="Catalogue de thèmes et d'extensions mis à jour régulièrement" />
                </div>
            </x-price>
        </div>
    </div>
</section>
