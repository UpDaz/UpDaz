<section id="competences">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <h2 class="text-3xl text-center sm:text-4xl">Mes compétences pour votre projet</h2>
        <div class="grid grid-cols-1 gap-16 md:gap-x-8 md:gap-y-16 md:grid-cols-3">
            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.calendar')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Gestion de projet</h3>
                </x-slot:title>
                <div class="flex flex-col items-start text-left -mb-1 space-y-2.5">
                    <x-skills.item text="Analyse des besoins" />
                    <x-skills.item text="Rédaction du cahier des charges" />
                    <x-skills.item text="Gestion et accompagnement des intervenants" />
                    <x-skills.item text="Proposition du retro-planning" />
                    <x-skills.item text="Suivis de projet" />
                </div>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.hand-tag')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Développement sur-mesure</h3>
                </x-slot:title>
                <div class="flex flex-col items-start text-left -mb-1 space-y-2.5">
                    <x-skills.item text="Digitalisation de vos processus métiers" />
                    <x-skills.item text="Outils adaptés aux utilisateurs" />
                    <x-skills.item text="Plateforme ergonomique et optimisée" />
                    <x-skills.item text="Système évolutif et adaptatif" />
                    <x-skills.item text="Intégration d'APIs RESTful" />
                </div>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-dot-com')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Création de site Webflow</h3>
                </x-slot:title>
                <div class="flex flex-col items-start text-left -mb-1 space-y-2.5">
                    <x-skills.item text="Personnalisation de thème" />
                    <x-skills.item text="Gestion du contenu CMS" />
                    <x-skills.item text="Mise en place de système de recherches et filtres" />
                    <x-skills.item text="Optimisations techniques SEO" />
                    <x-skills.item text="Installation d’outils “No-Code”" />
                </div>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-search')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">SEO - Référencement naturel</h3>
                </x-slot:title>
                <div class="flex flex-col items-start text-left -mb-1 space-y-2.5">
                    <x-skills.item text="Amélioration de la qualité de code" />
                    <x-skills.item text="Optimisation des performances" />
                    <x-skills.item text="Optimisation des assets (photos, vidéos, etc)" />
                    <x-skills.item text="Proposition de contenu" />
                    <x-skills.item text="Conseils sur les bonnes pratiques" />
                </div>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.pencil')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Intégration</h3>
                </x-slot:title>
                <div class="flex flex-col items-start text-left -mb-1 space-y-2.5">
                    <x-skills.item text="Structure des pages optimisées avec HTML 5" />
                    <x-skills.item text="Utilisation des technologies CSS 3 / TailwindCSS / Bootstrap / SASS" />
                    <x-skills.item text="Intéractions utilisateurs via Javascript / AlpineJS / jQuery" />
                    <x-skills.item text="Intégration en éléments réutilisables" />
                </div>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.database')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Hébergement / Maintenance</h3>
                </x-slot:title>
                <div class="flex flex-col items-start text-left -mb-1 space-y-2.5">
                    <x-skills.item text="Mise en ligne" />
                    <x-skills.item text="Support technique réactif" />
                    <x-skills.item text="Mise à jour des modules et des packages" />
                    <x-skills.item text="Reporting des erreurs" />
                    <x-skills.item text="Logs et correction de bugs" />
                </div>
            </x-skills.box>
            <div class="md:col-span-3">
                <div class="mx-auto md:w-1/2">
                    <x-skills.box>
                        <x-slot:icon>
                            @include('elements.icon.fingerprint')
                        </x-slot:icon>
                        <x-slot:title>
                            <h3 class="text-lg font-medium title-font">Data / Analytics</h3>
                        </x-slot:title>
                        <div class="flex flex-col items-start text-left -mb-1 space-y-2.5">
                            <x-skills.item text="Installation des outils de tracking Google" />
                            <x-skills.item text="Mise en place de tunnels de conversion" />
                            <x-skills.item text="Système de protection ReCaptcha" />
                            <x-skills.item text="Reporting des erreurs" />
                            <x-skills.item text="Outils de gestion et de respect du RGPD" />
                        </div>
                    </x-skills.box>
                </div>
            </div>
        </div>
    </div>
</section>
