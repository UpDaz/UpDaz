@extends('layouts.default')

@section('title')
    Offres landing page & site vitrine - Webflow - UpDaz
@endsection

@section('content')
    <div class="relative bg-blue text-white text-center py-16 md:py-20 md:pt-12">
        <div class="absolute h-full bottom-0 right-[10%] opacity-[15%] rotate-[30deg]">
            @include('elements/illustrations/webflow-header')
        </div>
        <div class="relative">
            <h1 class="font-title text-4xl lg:text-6xl font-bold">Landing page <br/> & site vitrine</h1>
            <h2 class="text-orange text-xl mt-4 mb-8">via Webflow</h2>
            <div class="container mx-auto text-center text-sm">
                <x-breadcrumb :links="['Webflow' => route('webflow')]" />
            </div>
        </div>
    </div>
    <div class="container px-8 py-12 mx-auto md:py-24">
        <h3 class="text-2xl text-orange mb-4">
            Présentation
        </h3>
        <p class="mb-2">
            Webflow est une plateforme de création de site internet et de gestion de contenu (CMS) en ligne.
            <br/>
            Lancée en 2013 afin de répondre aux problématiques de qualité de site proposés par les plateformes type Wix et de complexité de prise en main des CMS type Wordpress. Webflow se veut <span class="font-bold">intuitif, flexible et performant</span>.
        </p>
        <p class="mb-2">
            Sa particularité est de proposer une <span class="font-bold">expérience “no-code”</span> : la construction de votre site ne nécessite pas de connaissances poussées dans le développement web.
        <br/>
            Proposant une interface similaire aux logiciels de la suite Adobe (Illustrator, Photoshop, etc), les différents éléments du site se mettent en place via un système de 
            <x-tooltip color="#001A9E">
                <x-slot:message>
                    <span class="block p-6">
                        Utilisation du glisser-déposer en utilisant la souris de votre ordinateur.
                    </span>
                </x-slot>
                <x-slot:content>
                    <i>drag-and-drop</i>
                </x-slot>
            </x-tooltip>
            .
        <br/>
            Chaque élément peut être par la suite personnalisé en agissant sur ses caractéristiques.
        </p>
        <div class="my-8">
            <img class="block w-full max-w-screen-md mx-auto" src="{{ asset('img/screenshoots/webflow-interface.png') }}" width="768" height="423" alt="Exemple interface Webflow" title="Interface Webflow" loading="lazy"/>
            <p class="text-center text-sm italic mt-2">
                Interface Webflow
            </p>
        </div>
        <p class="mb-2">
            La plateforme propose une approche
            <x-tooltip color="#001A9E">
                <x-slot:message>
                    <span class="block p-6">
                        Solution As A Service
                    </span>
                </x-slot>
                <x-slot:content>
                    <i>SaaS</i>
                </x-slot>
            </x-tooltip>
            avec différentes offres, de la plus basique (et gratuite) permettant d’accéder à la plupart des fonctionnalités en version limitée, à la plus poussée (boutique en ligne et enregistrements CMS).
        <p>
        <p class="mb-2"> 
            Webflow propose de <span class="font-bold">nombreux thèmes et UI Kits</span> (packs d’éléments graphiques à utiliser pour construire son site) pouvant servir de base de travail. 
            <br>
            Régulièrement mis à jour et classés par thématiques, ils servent de base à la conception de votre site pour <span class="font-bold">un rendu moderne et dynamique</span>.
        </p>
        <p class="mb-2"> 
            En plus de la création graphique de votre site, la plateforme s’occupe de l’hébergement et de l’accès à votre site (via les services de cloud computing Amazone Web Service).
            <br/>
            Il est cependant possible d’exporter le code généré par Webflow afin de l’héberger et de l’utiliser pour une version plus poussée de votre application.
        </p>
        <div class="mt-8">
            <x-tips>
                <x-slot:content>
                    <p>
                        L’accès au site se fait via une URL (ex: www.updaz.fr).
                        <br/>
                        Dans sa version Starter, Webflow impose un format d’URL pour accéder au site (ex: updaz.webflow.io), pour obtenir une URL personnalisée, il est nécessaire de souscrire à une offre payante.
                        <br/>
                        Pour plus d’informations : <a href="https://webflow.com/pricing" target="_blank" class="underline">https://webflow.com/pricing</a>
                    </p>
                </x-slot>
            </x-tips>
        </div>
        <h3 class="text-2xl text-orange mb-4 mt-16">
            Quelle utilisation ?
        </h3>
        <p>
            3 typologies de sites sont possibles sur Webflow : <br/>
            <ul>
                <li>- Landing page & site vitrine</li>
                <li>- Site avec enregistrements CMS</li>
                <li>- Site E-commerce</li>
            </ul>
        </p>
        <h4 class="text-lg text-blue-dark mb-2 mt-8">
            Landing page & site vitrine
        </h4>
        <div class="lg:columns-2 gap-16">
            <p>
                Les sites sous forme de 
                <x-tooltip color="#001A9E">
                    <x-slot:message>
                        <span class="block p-6">
                            Site composé d'une page unique
                        </span>
                    </x-slot>
                    <x-slot:content>
                        <i>landing page</i>
                    </x-slot>
                </x-tooltip>
                ou les
                <x-tooltip color="#001A9E">
                    <x-slot:message>
                        <span class="block p-6">
                            Site composé de plusieurs pages de le contenu est statique.
                        </span>
                    </x-slot>
                    <x-slot:content>
                        <i>sites vitrines</i>
                    </x-slot>
                </x-tooltip>
                correspondent aux sites dans leur version la plus simple : le contenu est ajouté (textes, images) et personnalisé avant d’être mis en ligne de manière statique (le contenu n’est pas géré et mis à jour de manière automatique).
                <br/>
                Dans sa version de base Webflow propose d’intégrer des formulaires (dont la principale utilisation reste le formulaire de contact) qu’il est possible personnaliser en ajoutant des champs supplémentaires.
            </p>
            <div class="mt-8 mb-8">
                <x-tips>
                    <x-slot:content>
                        <p>
                            En fonction de l’offre souscrite auprès de Webflow, des limitations sont mise en place.
                            <br/>
                            Dans sa version la plus standard le formulaire ne peut être soumis que 50 fois en tout et pour tout.
                            <br/>
                            Pour plus d’informations : <a href="https://webflow.com/pricing" target="_blank" class="underline">https://webflow.com/pricing</a>
                        </p>
                    </x-slot>
                </x-tips>
            </div>
        </div>
        <h4 class="text-lg text-blue-dark mb-2 mt-8">
            Enregistrements CMS
        </h4>
        <p class="mb-2">
            L’utilisation des enregistrements CMS permets de <span class="font-bold">définir des collections</span> (composés d’un ou plusieurs items) simulant le comportant d’une base de données afin d’y enregistrer du contenu de manière dynamique.
            <br/>
            Une fois les différents champs qui composent un item définis, il sera alors possible de générer un ensemble cohérents d’<span class="font-bold">items basés sur le même model</span> et qui composeront la collection.
        </p>
        <p class="mb-2">
            Ces enregistrements peuvent être appelés et affichés de différentes manières sur le site. 
            <br/>
            Par exemple si votre site propose une section blog, il est possible de définir des articles composés d’une illustration, d’un texte de présentation et d’un texte pour le corps de l’article. Les articles pourront être affiché sous forme de vignettes sur la pages d’accueil (on demandera alors à afficher l’illustration et le texte de présentation) de manière automatique sans avoir besoin de recopier un à un chaque article.
        </p>
        <p>
            Cette fonctionnalité permet d’optimiser la centralisation des informations du site ainsi que de faciliter leur gestion au fur et à mesure que votre site prend de l’ampleur.
            <br/>
            Il sera de plus possible d'y appliquer des comportements spécifiques tels que la <span class="font-bold">gestion de l'ordre d'affichage</span> ou <span class="font-bold">le filtrage par catégorie</span>.
            <br/>
            De plus, les enregistrements CMS peuvent être <span class="font-bold">importés via un fichier CSV ou l’API CMS</span>.
        </p>
        <div class="mt-6 mb-10">
            <x-tips>
                <x-slot:content>
                    <p>
                        En fonction de l’offre souscrite, le nombre d’enregistrement CMS est plus ou moins limité.
                        <br/>
                        De plus l'ajout de fonctionnalités spécifiques sur les collections (filtrage, ordre, etc) nécessite dans la plupart des cas l'accès à l'option "code personnalisé", uniquement accessible via une offre payante.
                    </p>
                </x-slot>
            </x-tips>
        </div>
        <h4 class="text-lg text-blue-dark mb-2 mt-8">
            Sites e-commerce
        </h4>
        <p>
            Pour les boutiques en ligne, Webflow propose un système simplifié pour la gestion des produits mais impose une commission à la vente (2% du montant de chaque vente pour l’offre la plus attractive). 
        </p>
        <h3 class="text-2xl text-orange mb-4 mt-16">
            Mon accompagnement
        </h3>
        <p>
            À première vue Webflow propose une approche simplifiée et accessible à tous.
            <br/>
            Il est cependant important de comprendre que votre site sera régis par les mêmes règles, codes et contraintes lors de sa conception.
            <br/>
            Sans connaissances dans la création de site internet (que ce soit pour la partie graphique qui impact l’expérience utilisateur, le respect des règles SEO pour améliorer votre positionnement dans les résultats de Google ou la programmation pour optimiser vos enregistrements CMS), il est difficile et chronophage d’<span class="font-bold">obtenir un résultat en adéquation avec vos attentes</span>.
        </p>
        <p>
            Afin de garantir une qualité de site et <span class="font-bold">une expérience utilisateur à forte valeur ajoutée</span> au lancement de votre structure ou de votre produit, je propose un accompagnement adapté à vos besoins et à vos attentes.
        </p>
        <div class="max-w-screen-md mx-auto mt-8 overflow-x-scroll">
            @include('elements.webflow.pricing')
        </div>
        <div class="mt-16">
            @include('elements.contact')
        </div>
    </div>
@endsection
