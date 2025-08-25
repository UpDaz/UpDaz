<section id="opquast">
    <div class="container flex flex-col mx-auto">
        <div class="flex flex-col-reverse sm:flex-row ">
            <div
                class="flex flex-col items-start justify-start gap-8 border-t border-gray sm:w-3/4 sm:pr-16 sm:py-16 sm:border-r sm:border-t-0 sm:text-left">
                <div class="flex items-center gap-8">
                    <h2 class="text-3xl sm:text-4xl">
                        Développeur certifié <span class="uppercase text-yellow">Opquast</span>
                    </h2>
                    <div class="w-16">
                        @include('elements.icon.check-list')
                    </div>
                </div>
                <p class="leading-relaxed text-md">
                    <a href="https://www.opquast.com/" target="_blank"
                        class="inline-flex items-center gap-2 border-b text-nowrap border-gray">Opquast</a> est un programme de certification pour les
                    professionnels du web,
                    conçu pour évaluer les compétences et les connaissances en matière d'<b>optimisation et de qualité
                        de
                        site web</b>.
                    <br />
                    La certification repose sur un ensemble de <b>bonnes pratiques</b> pour le développement de sites
                    web,
                    connues sous le nom de "Référentiel de qualité"" et couvre des thèmes tels que l'accessibilité, les
                    performances, le SEO et l'expérience utilisateur.
                    <br /><br />
                    Les <b>240 règles du référentiel</b> Opquast se veulent vérifiables, universelles et réalistes afin
                    de
                    pouvoir être appliquées dans un maximum de contextes utilisateurs. Ce référentiel est mis à jour
                    tous
                    les 3 ans via un processus reposant sur une communauté active de professionnels afin de correspondre
                    au
                    mieux aux évolutions des usages du web.
                    <br>
                    Grâce à l'appropriation du modèle
                    <x-tooltip color="#001A9E">
                        <x-slot:message>
                            <span class="block p-6">
                                Modèle conçu comme base pour la gestion de la qualité web par E.Sloïm et E.Gateau en
                                2001
                                prenant en compte la Visibilité, la Perception, la Technique, les Contenus et les
                                Services
                            </span>
                        </x-slot>
                        <x-slot:content>
                            <i>VPTCS</i>
                        </x-slot>
                    </x-tooltip>
                    et à son adaptation à chaque projet, l'amélioration de la qualité de votre projet s'effectue tout au
                    long du cycle de vie et à chaque étape pour un résultat optimisé et cohérent.
                    <br /><br />
                    L'obtention de la certification "<b>Maitrise de la qualité en projet web</b>" démontre une approche
                    transversale dans la gestion de projet et dans l'accompagnement.
                    <br>
                    Le niveau "<b>Avancé</b>" correspond à d'excellentes connaissances des bonnes pratiques qualité Web
                    et
                    du vocabulaire associé ainsi que des compétences réelles et appréciables pour participer à des
                    projets
                    avec d’autres professionnels.
                </p>
                <div>
                    <x-button.secondary href="https://directory.opquast.com/fr/certificat/PUGT87/" target="_blank"
                        title="Vous avez des questions ?">
                        <span class="flex items-center gap-4 text-nowrap">
                            Voir ma certification
                        </span>
                        </x-button-secondary>
                </div>
            </div>
            <div class="px-12 md:px-16 sm:w-1/4 md:pt-16">
                <div class="sticky top-24">
                    <div class="relative">
                        @include('elements.html.webp-image', [
                            'source' => asset('img/label-opquast-avance.png'),
                            'alt' => 'Label Certification Avancée Opquast Matthieu DAZORD',
                            'width' => '150',
                            'height' => '109',
                            'class' => 'w-full',
                        ])
                        <div
                            class="absolute h-[1px] left-1/2 w-[200%] -translate-x-1/2 top-0 bg-gradient-to-r from-transparent via-gray to-transparent ">
                        </div>
                        <div
                            class="absolute h-[1px] left-1/2 w-[200%] -translate-x-1/2 bottom-0 bg-gradient-to-r from-transparent via-gray to-transparent ">
                        </div>
                        <div
                            class="absolute w-[1px] top-1/2 h-[200%] -translate-y-1/2 left-0 bg-gradient-to-b from-transparent via-gray to-transparent ">
                        </div>
                        <div
                            class="absolute w-[1px] top-1/2 h-[200%] -translate-y-1/2 right-0 bg-gradient-to-b from-transparent via-gray to-transparent ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
