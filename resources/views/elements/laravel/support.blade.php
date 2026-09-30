<section id="accompagnement" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <h2 class="text-3xl text-center sm:text-4xl">Mon accompagnement,<br/>pour votre <span class="text-yellow">application Laravel</span></h2>
        <p class="text-center">Laravel est un outil puissant mais obtenir un résultat professionnel demande méthode et expertise.<br/>En tant que développeur Laravel à Bordeaux, <span class="text-nowrap">je vous aide à :</span></p>
        <div class="grid grid-cols-1 md:gap-x-8 md:gap-y-16 md:grid-cols-3">

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-search')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Analyse et conseils de vos besoins</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.calendar')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Gestion du planning et des réalisations</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.hand-tag')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Digitalisation et numérisation de vos besoins</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-dot-com')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Définition d'une structure claire et cohérente pour le contenu</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.database')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Intégration d'APIs RESTful et connexion à des ressources externes</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-search')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Optimisation du référencement (SEO) et des performances</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.hand-tag')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Mise en place de tunnel de conversion des visiteurs en prospect</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.pencil')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Conception d'interface fluide, dynamique et engageante</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.database')
                </x-slot:icon>
                <x-slot:title>
                    <h3 class="text-base">Mise en ligne et maintenance de votre application</h3>
                </x-slot:title>
            </x-skills.box>
        </div>
    </div>
</section>
