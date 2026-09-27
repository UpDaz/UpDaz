<section id="accompagnement" class="pt-24 -mt-24">
    <div class="container flex flex-col gap-8 mx-auto md:gap-16">
        <h2 class="text-3xl text-center sm:text-4xl">Mon accompagnement,<br/>pour votre application web sur-mesure</h2>
        <p class="text-center">Laravel est un outil puissant mais obtenir un résultat professionnel demande méthode et expertise.<br/>En tant que développeur Laravel à Bordeaux, je vous aide à :</p>
        <div class="grid grid-cols-1 gap-16 md:gap-x-8 md:gap-y-16 md:grid-cols-2">

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-search')
                </x-slot:icon>
                <x-slot:title>
                    <h3>Analyse et conseils de vos besoins</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.calendar')
                </x-slot:icon>
                <x-slot:title>
                    <h3>Gestion du planning et des réalisations</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.hand-tag')
                </x-slot:icon>
                <x-slot:title>
                    <h3>Digitalisation et numérisation de vos besoins</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-dot-com')
                </x-slot:icon>
                <x-slot:title>
                    <h3>Définition d'une structure claire et cohérente pour le contenu</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.database')
                </x-slot:icon>
                <x-slot:title>
                    <h3>Intégration d'APIs RESTful et connexion à des ressources externes</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.view-search')
                </x-slot:icon>
                <x-slot:title>
                    <h3>Optimisation du référencement (SEO) et des performances</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.hand-tag')
                </x-slot:icon>
                <x-slot:title>
                    <h3>Mise en place de tunnel de conversion des visiteurs en prospect</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.pencil')
                </x-slot:icon>
                <x-slot:title>
                    <h3>Conception d'interface fluide, dynamique et engageante</h3>
                </x-slot:title>
            </x-skills.box>

            <x-skills.box>
                <x-slot:icon>
                    @include('elements.icon.database')
                </x-slot:icon>
                <x-slot:title>
                    <h3>Mise en ligne et maintenance de votre application</h3>
                </x-slot:title>
            </x-skills.box>
        </div>
    </div>
</section>
