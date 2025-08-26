@extends('layouts.default')

@section('title')
    Offre sur-mesure & application métier Laravel - UpDaz
@endsection

@section('meta-description')
    Digitalisez vos processus métiers et optez pour la fiabilité, la performance et la sécurité d'une application web
    sur-mesure avec Laravel.
@endsection

@section('content')
    <div class="container flex flex-col gap-16 mx-auto">
        <div class="relative text-white text-center mt-24 overflow-hidden ">
            <div class="flex flex-col gap-4 mx-auto">
                <h1 class="text-4xl font-bold font-title lg:text-5xl">Application métier<br /> & sur-mesure</h1>
                <h2 class="text-xl">Développement d'applications web avec Laravel</h2>
                <div class="flex flex-col gap-4 text-sm text-center">
                    <div data-element="line-horizontal" class="h-[1px] w-1/4 mx-auto"></div>
                    <x-breadcrumb :links="['Laravel' => route('laravel')]" />
                </div>
            </div>
        </div>
        <div class="text-justify">
            <div class="relative mb-8 md:float-right md:w-1/4 md:ml-16">
                @include('elements.laravel.menu')
                <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 -bottom-8">
                </div>
                <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 -left-8"></div>
            </div>
            <span class="*:w-16 *:h-auto mb-2 inline-block">
                @include('elements.icon.programming')
            </span>
            <h3 class="text-2xl" id="introduction">
                Laravel, qu’est-ce que c’est ?
            </h3>
            <p class="mb-4">
                Laravel est un
                <x-tooltip color="blue" displayIcon="{{ true }}">
                    <x-slot:message>
                        Boite à outils servant aux développeurs à créer des sites sur-mesure
                    </x-slot>
                    <x-slot:content>
                        <i>Framework</i>
                    </x-slot>
                </x-tooltip>
                permettant la conception d’applications web.
                <br />
                Créé en juin 2011 par Taylor Otwell, cet outil open-source a su évoluer et convaincre <b>une communauté de
                    développeurs de plus en plus importante</b>, participant activement à son évolution.
            </p>
            <p class="mb-4">
                Basé sur le langage de programmation PHP, il met à la disposition des développeurs un ensemble de composants
                <b>facilement utilisables et évolutifs</b> afin de construire des <b>applications complexes et
                    autonomes</b>.
            </p>
            <p class="mb-4">
                Reposant sur un modèle d’architecture
                <x-tooltip color="blue">
                    <x-slot:message>
                        <span class="block p-6">
                            Modèle-Vue-Controller : séparation logique entre les données, le design et les processus métier
                        </span>
                    </x-slot>
                    <x-slot:content>
                        <i>MVC</i>
                    </x-slot>
                </x-tooltip>
                , les projets conçus avec Laravel se caractérisent par leur fiabilité, leur
                <x-tooltip color="blue">
                    <x-slot:message>
                        <span class="block p-6">
                            conçu pour évoluer facilement
                        </span>
                    </x-slot>
                    <x-slot:content>
                        <i>scalabilité</i>
                    </x-slot>
                </x-tooltip>
                et leur performance.
            </p>
            <p>
                Laravel propose tout un <b>écosystème d’outils et de services</b> facilitant le développement et le
                fonctionnement de votre projet (on peut par exemple citer “Vapor” pour gérer la mise en ligne de votre
                projet,
                “Nova” pour ajouter un tableau d’administration ou encore ”Cashier” pour ajouter un système de facturation).
            </p>

            <h3 class="pt-16 text-2xl" id="quelle-utilisation">
                Quelle utilisation ?
            </h3>
            <p class="mb-4">
                L’intérêt d’utiliser un framework comme base est de <b>pouvoir modeler votre application web en fonction de
                    vos
                    besoins</b>.
                <br />
                Des outils comme <a href="{{ route('webflow') }}" class="underline">Webflow</a> Prestashop ou Wrodpress offrent une expérience formatée et
                vous
                impose une base standardisée (aussi bien pour l’affichage du site que pour son fonctionnement) demandant
                d’importantes ressources pour s’adapter aux spécificités métiers.
                <br />
                Un framework permet de gagner en flexibilité, en spécialisation et en performance.
            </p>
            <p class="mb-4">
                Les possibilités sont donc “infinies” et vont des plus classiques aux plus spécifiques :
                <br />
                landing page, site vitrine, boutique en ligne, e-learning, CRM, annuaires en ligne, API, gestion
                d’abonnements,
                extranet, …
            </p>
            <div class="mt-8 mb-8">
                <x-tips>
                    <x-slot:content>
                        <p>
                            Le site sur lequel vous naviguez actuellement a été conçu avec Laravel.
                            <br />
                            Bien qu’il s’agisse avant tout d’un site vitrine, il possède des performances optimisées et
                            pourra
                            potentiellement évoluer pour intégrer la gestion d’un blog ou une partie CRM.
                        </p>
                    </x-slot>
                </x-tips>
            </div>
            <h3 class="pt-16 text-2xl" id="accompagnement">
                Mon accompagnement
            </h3>
            <p class="mb-4">
                La digitalisation de vos processus métier fait partie des enjeux primordiaux dans la création et l’évolution
                de
                votre entreprise.
                <br />
                Choisir les outils les plus adaptés à ses ambitions permet d’<b>éviter les contraintes liées à certaines
                    technologies</b>.
            </p>
            <p class="mb-4">
                Il peut être tentant d’opter pour une solution clé-en-main telles que Wordpress, Prestashop ou Shopify mais
                ces
                technologies, bien que conçues pour couvrir des besoins globaux (créer un blog, ouvrir une boutique en
                ligne,
                etc), <b>ne répondent pas à des besoins spécifiques</b>.
                <br />
                Ceci est d’autant plus vrai si vous souhaitez une plateforme <b>optimisée et durable dans le temps</b>.
            </p>
            <p class="mb-4">
                Mettre en place des processus métiers demande une vision technique afin de garantir son bon fonctionnement
                et
                éviter les erreurs de logique et applicatives.
                <br />
                Aborder ses processus avec un développeur au moment de la rédaction du cahier des charges est donc
                nécessaire.
            </p>
            <div class="items-end justify-between md:flex ">
                <div>
                    <h3 class="pt-16 text-2xl" id="quel-budget">
                        Quel budget ?
                    </h3>
                    <p class="mb-4">
                        Le coût de conception d’une plateforme web via Laravel va dépendre de ce que vous souhaitez mettre
                        en
                        place sur votre site et des spécificités.
                        <br />
                        On distinguera alors plusieurs points essentiels dans l’établissement du budget :
                    <ul>
                        <li class="flex items-center justify-start gap-2 align-top">
                            <span class="*:w-6 *:h-auto">
                                @include('elements.icon.arrow-right')
                            </span>
                            La conception du design
                        </li>
                        <li class="flex items-center justify-start gap-2 align-top">
                            <span class="*:w-6 *:h-auto">
                                @include('elements.icon.arrow-right')
                            </span>
                            Le développement des fonctionnalités
                        </li>
                        <li class="flex items-center justify-start gap-2 align-top">
                            <span class="*:w-6 *:h-auto">
                                @include('elements.icon.arrow-right')
                            </span>
                            La création du contenu
                        </li>
                        <li class="flex items-center justify-start gap-2 align-top">
                            <span class="*:w-6 *:h-auto">
                                @include('elements.icon.arrow-right')
                            </span>
                            Les dépenses de fonctionnement
                        </li>
                    </ul>
                    </p>
                </div>
                <div class="w-1/3 mx-auto mt-4 md:mt-0">
                    <div class="relative p-8 mx-auto bg-white md:w-1/2">
                        <img src="{{ asset('img/logos/laravel.svg') }}" class="w-full" alt="Logo Laravel">
                        <p class="mt-4 text-sm italic text-center text-dark">
                            Logo Laravel
                        </p>
                        <div data-element="line-horizontal"
                            class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 top-0"></div>
                        <div data-element="line-horizontal"
                            class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 bottom-0"></div>
                        <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 left-0">
                        </div>
                        <div data-element="line-vertical"
                            class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 right-0"></div>
                    </div>
                </div>
            </div>
            <h4 class="pt-8 text-lg" id="design">
                Le design
            </h4>
            <p class="mb-4">
                La conception du design de votre site internet est une étape importante pour votre site internet et pour la
                communication qui va en résulter. Elle s’inscrit dans votre stratégie de communication.
                <br />
                En fonction du budget alloué, plusieurs alternatives sont possibles :
            <ul class="mb-4">
                <li class="flex justify-start gap-2 align-top">
                    <span class="*:w-6 *:h-auto">
                        @include('elements.icon.arrow-right')
                    </span>
                    Utiliser un thème HTML pré-fabriqué en vente sur des plateformes spécialisées.
                </li>
                <li class="flex justify-start gap-2 align-top">
                    <span class="*:w-6 *:h-auto">
                        @include('elements.icon.arrow-right')
                    </span>
                    Faire appel à un graphiste pour définir une identité visuelle et créer des maquettes que le développeur
                    intégrera par la suite.
                </li>
            </ul>
            </p>
            <p class="mb-4">
                Si la première option est la plus accessible et la moins couteuse (les thèmes se vendent quelques centaines
                voir
                dizaines d’euros), elle implique que le design de votre application risque d’être utilisé par d’autres
                plateforme.
                <br />
                De plus, les thèmes proposés ne garantissent pas un fonctionnement optimal, les modifier demande du temps de
                développement et bien souvent il est nécessaire de compléter avec des éléments graphiques créés sur-mesure.
            </p>
            <p>
                Faire appel à un graphiste (ou à un webdesigner) garantie un <b>accompagnement sur-mesure</b>.
                <br />
                En fonction de vos besoins pour le site (et plus généralement vos besoins en communication), vous obtiendrez
                <b>une identité visuelle unique</b>, applicable sur différents supports de communication et qui vous suivra
                tout
                au long de votre projet.
                <br />
                Le coût d’un graphiste varie suivant son tarif journalier et s’élève à plusieurs centaines d’euros en
                fonction
                de son accompagnement, des livrables et de son expérience.
            </p>
            <h4 class="pt-8 text-lg" id="developpement">
                Le développement
            </h4>
            <p class="mb-4">
                Une fois que le design de votre site est établi, la phase de développement peut commencer.
                <br />
                Il s’agit ici de retranscrire en langages informatiques deux aspects de votre site :
            </p>
            <ul class="mb-4">
                <li class="flex items-center justify-start gap-2 align-top">
                    <span class="*:w-6 *:h-auto">
                        @include('elements.icon.arrow-right')
                    </span>
                    Le design (préalablement défini) regroupant l’aspect visuel et les interactions avec l’utilisateur.
                </li>
                <li class="flex items-center justify-start gap-2 align-top">
                    <span class="*:w-6 *:h-auto">
                        @include('elements.icon.arrow-right')
                    </span>
                    Les processus métiers qui définissent les actions concrètes effectuées par votre application web.
                </li>
            </ul>
            <p class="mb-4">
                En fonction du choix du design et de sa complexité (utilisation d’un thème ou accompagnement par un
                graphiste)
                l’intégration peut se montrer plus ou moins laborieuse.
                <br />
                Le thème imposera les technologies à utiliser (framework CSS, librairies JS) mais gagnera à proposer des
                composants visuels clé-en-main.
                <br />
                Une intégration
                <x-tooltip color="blue">
                    <x-slot:message>
                        <span class="block p-6">
                            Créé en partant de zéro
                        </span>
                    </x-slot>
                    <x-slot:content>
                        <i>from scratch</i>
                    </x-slot>
                </x-tooltip>
                permettra un contrôle total des éléments de votre site, <b>une optimisation des performances</b> et donc
                <b>un
                    rendu plus qualitatif</b> (impactant l’expérience utilisateur et le SEO).
            </p>
            <p class="mb-4">
                Le développement des processus métiers peut s’appuyer sur certains services déjà existants mais
                nécessiteront la
                plupart du temps soit une adaptation, soit une développement complet afin de correspondre au mieux à vos
                besoins.
            </p>
            <p class="mb-4">
                À l’instar de l’accompagnement par un graphiste, le développement des fonctionnalités se calcule via un
                tarif
                journalier.
            </p>
            <p>
                Il reste tout à fait envisageable d’adapter le fonctionnement de votre plateforme afin d’<b>utiliser des
                    outils
                    déjà existants</b> faisant baisser le coût de développement.
            </p>
            <h4 class="pt-8 text-lg" id="contenu">
                Le contenu
            </h4>
            <p>
                Le contenu de votre site regroupe tous les éléments d’information : textes, images, vidéos, audio, …
                <br />
                Ces éléments peuvent être conçus par vos soins ou par des professionnels (copywriters pour le contenu
                textuel, vidéaste pour filmer et monter les vidéos, etc).
                <br />
                Tout ceci définit la qualité de votre site et impactera l’expérience utilisateur (UX) et votre
                référencement
                naturel (SEO), il peut donc être intéressant de faire appel à des professionnels afin de garantir et
                maintenir une qualité de site.
            </p>
            <div class="mt-8 mb-8">
                <x-tips>
                    <x-slot:content>
                        <p>
                            Pour afficher les meilleurs résultats dans ses recherches, Google analyse en profondeur
                            chaque
                            site afin de retenir les plus qualitatifs.
                            <br />
                            Le temps de chargement des pages, la richesses du contenu et le temps passé par chaque
                            visiteur
                            sur le site font partie des variables utilisées par Google.
                        </p>
                    </x-slot:content>
                </x-tips>
            </div>
            <h4 class="pt-8 text-lg" id="depenses-fonctionnement">
                Les dépenses de fonctionnement
            </h4>
            <p>
                Une fois votre site créé, des services sont nécessaires à son bon fonctionnement : l’achat d’un nom de
                domaine
                (qui permettra d’accéder à votre site via une URL) et la location d’un server d’hébergement (qui hébergera
                le
                code de votre site) sont <b>obligatoires</b>.
            </p>
            <div class="mt-8 mb-8">
                <x-tips>
                    <x-slot:content>
                        <p>
                            Il existe une multitude d’offres d’hébergement pour votre site.
                            <br />
                            Les acteurs les plus importants du marché étant OVH (français) et Amazone Web Services
                            (américain).
                            <br />
                            Le coût de l’hébergement peut fortement varier en fonction des options et ressources
                            nécessaires.
                        </p>
                    </x-slot>
                </x-tips>
            </div>
            <p>
                À ceci peut se rajouter des services supplémentaires pour optimiser la gestion des emails, s’assurer d’une
                maintenance de votre site 7j/7 et 24h/24, gérer le consentement des cookies, etc.
            </p>
        </div>
        <div class="relative pt-16" id="contact">
            <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[100%] -translate-x-1/2 top-0"></div>
            @include('elements.contact')
        </div>
    </div>
@endsection
