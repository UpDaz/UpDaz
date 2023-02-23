@extends('layouts.default')

@section('title')
Offre boutique en ligne & e-commerce - UpDaz
@endsection

@section('meta-description')
Votre boutique e-commerce en ligne clé-en-main grâce au CMS Prestashop. Profiter d'un large choix de modules et de thèmes adaptés à vos besoins. 
@endsection

@section('content')
    <div class="relative bg-blue text-white text-center py-16 md:py-20 md:pt-32 md:-mt-24 overflow-hidden min-h-[50vh] md:min-h-0">
        <div class="absolute h-full bottom-10 lg:left-2/4 lg:-translate-x-1/2 opacity-10">
            @include('elements/illustrations/prestashop-header')
        </div>
        <div class="relative">
            <h1 class="font-title text-4xl lg:text-6xl font-bold">E-commerce &<br/>boutique en ligne</h1>
            <h2 class="text-orange text-xl mt-4 mb-8">via Prestashop</h2>
            <div class="container mx-auto text-center text-sm">
                <x-breadcrumb :links="['Prestashop' => route('prestashop')]" />
            </div>
        </div>
    </div>
    <div class="container px-8 py-12 mx-auto md:px-0 md:py-24 relative text-justify">
        <div class="bg-gray-100 px-8 py-8 md:float-right md:w-1/3 md:ml-16 md:mb-8">
            @include('elements.prestashop.menu')
        </div>
        <h3 class="text-2xl text-orange mb-4 pt-8" id="introduction">
            Prestashop :  la boutique en ligne clé en main
        </h3>
        <p class="mb-2">
            Prestashop est un
            <x-tooltip color="#001A9E">
                <x-slot:message>
                    <span class="block p-6">
                        Content Management System
                    </span>
                </x-slot>
                <x-slot:content>
                    <i>CMS</i>
                </x-slot>
            </x-tooltip>
            développé créé par 5 étudiants de l’école EPITECH en 2017 dont l’objectif est de <b>proposer une plateforme e-commerce complète</b> ne nécessitant <b>pas de développement</b>. 
            <br/>
            Parmi les systèmes inclut dans Prestashop, on peut retrouver : la gestion des produits (avec un système de catégorisation), le suivis des commandes, la création de contenu, l’envoi des emails, le filtrage des produits, gestion des promotions, etc.
        </p>
        <p class="mb-2">
            Reposant sur le langage de programmation PHP, le création de la boutique se fait via une interface d’installation demandant des informations de base mais <b>pouvant nécessiter quelques connaissances en informatique</b> notamment pour garantir la <b>compatibilité</b> avec la version de PHP ainsi que la bonne <b>connexion à la base de données</b>.
        </p>
        <p class="mb-2">
            Depuis 2017 et la version 1.7 dont le système était codé sur une base “fait maison”, Prestashop est passé sur une base Symfony,
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
            réputé pour sa flexibilité et sa robustesse. 
            <br/>
            Via cette mise à jour majeure, l’objectif était de <b>gagner en performances</b>, en solidité et de <b>s’adapter aux exigences actuelles</b> (thème mobile-first, simplification de l’interface administrateur, amélioration de la gestion des modules, etc).
        </p>
        <p class="mb-2">
            Une fois l’installation terminée, 2 interfaces sont disponibles : l’interface publique qui correspond à la boutique en ligne via laquelle le visiteur - et potentiel client - fera ses achats, et l’interface d’administration qui permet de gérer tous les éléments de votre boutique.
        </p>
        <p>
            Par défaut la partie publique du site repose sur le thème par défaut de Prestashop et intègre une base d’extensions et de modules.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-8">
            <div>
                <img src="{{ asset('img/screenshoots/prestashop-front.png') }}" alt="Thème par defaut de Prestashop" load="lazy"/>
                <p class="text-center text-sm italic mt-2">
                    Interface publique de Prestashop - thème par default
                    <br/>
                    <a href="https://demo.prestashop.com/#/fr/front" target="_blank" class="underline">Démo @include('elements.svg-icons.external-link')</a>
                </p>
            </div>
            <div>
                <img src="{{ asset('img/screenshoots/prestashop-back.png') }}" alt="Interface administration de Prestashop" load="lazy"/>
                <p class="text-center text-sm italic mt-2">
                    Interface administration de Prestashop
                    <br/>
                    <a href="https://demo.prestashop.com/#/fr/back" target="_blank" class="underline">Démo @include('elements.svg-icons.external-link')</a>
                </p>
            </div>
        </div>
        <h3 class="text-2xl text-orange pt-16 mb-4" id="extensions">
            Le système d’extensions
        </h3>
        <p>
            Bien que Prestashop propose <b>une expérience complète</b> dans son état initial, de nombreux éléments de personnalisation peuvent se greffer dessus. 
        </p>
        <h4 class="text-lg text-blue-dark mb-2 pt-8" id="hooks">
            Les hooks
        </h4>
        <p class="mb-2">
            Prestashop utilise un système de 
            <x-tooltip color="#001A9E">
                <x-slot:message>
                    <span class="block p-6">
                        Point d'encrage
                    </span>
                </x-slot>
                <x-slot:content>
                    <i>hook</i>
                </x-slot>
            </x-tooltip>
            afin d’afficher et d’exécuter le code du module aux endroits où le module est greffé.
        </p>
        <p class="mb-2">
            De nombreux hooks sont installés par défaut sur les pages, certain sont communs à toutes les pages du site (displayHeader, displayFooter, etc), d’autres sont spécifiques à une page (displayHome pour la page d’accueil, displayProductExtraContent pour ajouter du contenu sur la page produit, etc) et certain sont même appelé lors d’une action (actionCartSave lorsqu’un nouveau panier est enregistré, actionProductAdd lorsqu’un produit est ajouté au panier, etc).
        </p>
        <p>
            Ce système spécifique permet de <b>centraliser et de réutiliser les fonctionnalités</b> du module bien qu’il faille faire attention aux <b>problèmes de compatibilité principalement</b> entre les modules qui sont greffés sur un même hook.
        </p>
        <h4 class="text-lg text-blue-dark mb-2 pt-8" id="catalogue-de-module">
            Le catalogue de modules
        </h4>
        <p class="mb-2">
            Ces extensions sont proposées via la <a href="https://addons.prestashop.com/" target="_blank" class="underline">marketplace de Prestashop @include('elements.svg-icons.external-link')</a>.
            <br/>
            La plupart du temps payantes, elles sont développées par des développeurs tierces et <b>vérifiées par Prestashop</b> avant d’être mis en ligne. 
        </p>
        <p class="mb-2">
            On peut y retrouver :<br/>
        </p>
            <ul>
                <li class="flex justify-start align-top gap-2">
                    @include('elements.svg-icons.animated.long-arrow-right')              
                    des thèmes
                </li>
                <li class="flex justify-start align-top gap-2">
                    @include('elements.svg-icons.animated.long-arrow-right')
                    des éléments de navigation (recherche avancées, mega-menu, etc)
                </li>
                <li class="flex justify-start align-top gap-2">
                    @include('elements.svg-icons.animated.long-arrow-right')
                    des modes paiements (banques spécifiques, paiements en plusieurs fois etc)
                </li>
                <li class="flex justify-start align-top gap-2">
                    @include('elements.svg-icons.animated.long-arrow-right')
                    de la gestion de logistique (transporteurs, gestion du stocks poussée, etc)
                </li>
                <li class="flex justify-start align-top gap-2">
                    @include('elements.svg-icons.animated.long-arrow-right')
                    des éléments UX pour la fiche produit
                </li>
                <li class="flex justify-start align-top gap-2">
                    @include('elements.svg-icons.animated.long-arrow-right')
                    etc.
                </li>
            </ul>
        <p class="mt-4">
            Grâce à ce catalogue de <b>plus de 3000 modules</b>, Prestashop permets de faire évoluer sa boutique en ligne en fonction de la demande.
        </p>
        <h4 class="text-lg text-blue-dark mb-2 pt-8" id="developpement-specifique">
            Développement spécifique
        </h4>
        <p class="mb-2">
            Il est de plus tout à fait possible de développer un module sur-mesure correspondant à des <b>besoins spécifiques</b> (le module ne sera alors pas disponible sur la marketplace mais directement installé sur la boutique).
        </p>
        <p class="mb-2">
            J’ai dors et déjà développé plusieurs modules dont certains sont accessibles sur la marketplace :
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="https://addons.prestashop.com/fr/blocs-onglets-bannieres/88810-bandeaux-avant-apres.html" target="_blank" class="bg-slate-100 px-12 py-10 text-center hover:bg-blue hover:text-white">
                    <img src="{{ asset('img/logos/prestashop.svg') }}" width="50" class="mx-auto mb-2" alt="Logo Prestashop">
                    Module <i>Bandeau Avant-Après</i>
                </a>
                <a href="https://addons.prestashop.com/fr/inscription-processus-de-commande/89281-barre-d-ajout-au-panier.html" target="_blank" class="bg-slate-100 px-12 py-10 text-center hover:bg-blue hover:text-white">
                    <img src="{{ asset('img/logos/prestashop.svg') }}" width="50" class="mx-auto mb-2" alt="Logo Prestashop">
                    Module <i>Barre d'ajout au panier</i>
                </a>
        </div>
        <h3 class="text-2xl text-orange pt-16 mb-4" id="accompagnement">
            Mon accompagnement
        </h3>
        <p>
            Bien que le CMS Prestashop soit proposé gratuitement, la création d’une boutique peut se révéler plus compliquée que prévue et <b>nécessite un savoir faire</b>.
            <br/>
            Cet outils étant particulièrement complet de base et possédant des <b>notions spécifiques</b> (page CMS, système d’attributs, hooks, etc), je vous propose de <b>vous accompagner</b> de bout en bout dans la mise en place de votre boutique en ligne afin de garantir <b>un fonctionnement optimisé</b> et de <b>répondre à vos besoins spécifiques</b>.
        </p>
        <div class="max-w-screen-md mx-auto mt-8 overflow-x-scroll">
            @include('elements.prestashop.pricing')
        </div>
    </div>
    @include('elements.prestashop.references')
    <div class="container px-8 py-12 mx-auto md:px-0 md:py-24" id="contact">
        @include('elements.contact')
    </div>
@endsection
