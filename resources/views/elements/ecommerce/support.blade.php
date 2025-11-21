<section id="accompagnement" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <h2 class="text-3xl text-center sm:text-4xl">Mon accompagnement,<br />pour votre site e-commerce</h2>
        <p class="text-center">Lunar est un outils pour les développeurs permettant d'obtenir un résultat professionnel
            mais demande méthode et expertise.<br />Chez UpDaz, je vous aide à :</p>
        <div class="grid grid-cols-1 gap-16 md:gap-x-8 md:gap-y-16 md:grid-cols-2">
            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-search')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Analyse et conseils de vos besoins et contraintes</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.calendar')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Gestion du planning et des réalisations</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-dot-com')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Définission d'une structure claire et cohérente pour le
                        contenu</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.hand-tag')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Développement et intégration d'outils tiers</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.database')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Intégration d'APIs RESTful et connexion à des ressources
                        externes</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-search')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Optimisation du référencement (SEO) et des performances
                    </h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.hand-tag')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Mise en place de tunnel de vente des visiteurs en
                        client</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.pencil')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Conception d'interface fluide, dynamique et engageante
                    </h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.database')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Mise en ligne et maintenance de votre application</h3>
                </x-slot:title>
            </x-skills.box>
            
            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-search')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-lg font-medium title-font">Mise en place d'outils de suivis des KPIs / statistiques</h3>
                </x-slot:title>
            </x-skills.box>
        </div>
    </div>
</section>
