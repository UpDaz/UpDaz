<div id="opquast" class="relative px-8 md:px-16 py-16 md:py-24 bg-blue">
    <div class="hidden md:block absolute right-0 top-1/2 -translate-y-1/2 height-1/2 opacity-10">
        @include('elements.illustrations.certification')
    </div>
    <div class="relative">
        <div class="flex items-center gap-4 md:gap-8 lg:gap-12 mb-6">
            <h2 class="font-title bold text-3xl text-white">
                Développeur certifié <span class="uppercase">Opquast</span>
            </h2>
            <img src="{{ asset('img/label-opquast-avance.png')}}" alt="Label Certification Avancée Opquast Matthieu DAZORD" width="100"/>
        </div>
            <p class="text-white">
                L'obtention de la certification "<b>Maitrise de la qualité en projet web</b>" attribué par l'organisme de formation <a href="https://www.opquast.com/" target="_blank" class="border-b-2">Opquast @include('elements.svg-icons.external-link')</a> offre une approche transversale dans la gestion de projet et dans l'accompagnement que je propose.
                <br>
                Avec un score de 835/1000 le niveau "Avancé" correspondant à d'excellentes connaissances des bonnes pratiques qualité Web et du vocabulaire associé ainsi que des compétences réelles et appréciables pour participer à des projets avec d’autres professionnels.
                <br>
                Grâce à l'appropriation du modèle
                <x-tooltip color="#001A9E">
                    <x-slot:message>
                        <span class="block p-6">
                            Modèle conçu comme base pour la gestion de la qualité web par Elie Sloïm et Eric Gateau en 2001 prenant en compte la Visibilité, la Perception, la Technique, les Contenus et les Services
                        </span>        
                    </x-slot>
                    <x-slot:content>
                        <i>VPTCS</i>
                    </x-slot>
                </x-tooltip>
                et à son adaptation à chaque cas, l'amélioration de la qualité de votre projet s'effectue tout au long du cycle de vie et à chaque étape pour un résultat optimal.
            </p>
            <p class="md:flex justify-end mt-4 gap-4">
                <a href="https://directory.opquast.com/fr/certificat/PUGT87/" target="_blank" class="block text-center bg-blue-dark hover:bg-brown text-white px-6 py-3 rounded shadow-md mb-4 md:mb-0">
                    Authentifier ma certification @include('elements.svg-icons.external-link')
                </a>
                <a href="#contact" @click.prevent="scrollToTarget('#contact')" class="block text-center bg-orange hover:bg-brown text-white px-6 py-3 rounded shadow-md" title="Lien vers contact">
                    Je veux en apprendre plus
                </a>
            </p>
        </div>
    </div>
</div>
