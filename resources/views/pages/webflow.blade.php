@extends('layouts.default')

@section('title')
Offre landing page & site vitrine Webflow - UpDaz
@endsection

@section('meta-description')
Créez votre landing page et site vitrine grâce à l'outils en ligne no-code Webflow. Obtenez un site moderne et performant tout en gardant la main sur son contenu.
@endsection

@section('content')
    <div class="relative bg-gradient-to-br from-blue-dark to-blue text-white text-center -mt-24 overflow-hidden min-h-[50vh] md:min-h-0">
        <div class="px-8 py-16 pt-32 pb-24 bg-pattern-1 md:px-16">
            <div class="container mx-auto">
                <h1 class="text-4xl font-bold font-title lg:text-6xl">Landing page <br/> & site vitrine</h1>
                <h2 class="mt-4 mb-8 text-xl ">Mise en place de landing-page via Webflow</h2>
                <div class="container mx-auto text-sm text-center">
                    <x-breadcrumb :links="['Webflow' => route('webflow')]" />
                </div>
            </div>
        </div>
    </div>
    <div class="container px-8 py-16 mx-auto text-justify md:px-16 md:py-0 md:pt-24">
        <div class="mb-8 bg-gray-100 md:float-right md:w-1/3 md:ml-16">
            <div class="px-8 py-8 bg-pattern-2">
                @include('elements.webflow.menu')
            </div>
        </div>
        <h3 class="text-2xl" id="introduction">
            Présentation
        </h3>
        <div class="w-20 h-1 my-2 rounded bg-blue"></div>
        <div class="items-center justify-between gap-8 lg:flex content-middle">
            <div>
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
            </div>
        </div>
        <div class="my-12">
            <img class="block w-full max-w-screen-md mx-auto" src="{{ asset('img/screenshoots/webflow-interface.png') }}" width="768" height="423" alt="Exemple interface Webflow" title="Interface Webflow" loading="lazy"/>
            <p class="mt-2 text-sm italic text-center">
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
        <div class="items-end justify-between gap-4 md:flex">
            <div>
                <h3 class="pt-16 text-2xl" id="quelle-utilisation">
                    Quelle utilisation ?
                </h3>
                <div class="w-20 h-1 my-2 rounded bg-blue"></div>
                <p>
                    3 typologies de sites sont possibles sur Webflow : <br/>
                    <ul>
                        <li class="flex justify-start gap-2 align-top">
                            @include('elements.icon.animated', ['icon' => 'o-arrow-long-right', 'class' => 'sm:w-6 sm:h-6 min-w-[24px]'])              
                            Landing page & site vitrine
                        </li>
                        <li class="flex justify-start gap-2 align-top">
                            @include('elements.icon.animated', ['icon' => 'o-arrow-long-right', 'class' => 'sm:w-6 sm:h-6 min-w-[24px]'])
                            Site avec enregistrements CMS
                        </li>
                        <li class="flex justify-start gap-2 align-top">
                            @include('elements.icon.animated', ['icon' => 'o-arrow-long-right', 'class' => 'sm:w-6 sm:h-6 min-w-[24px]'])
                            Site E-commerce
                        </li>
                    </ul>
                </p>
            </div>
            <div class="w-1/2 mx-auto mt-4 md:mt-0">
                <div class="mx-auto md:w-1/6">
                    <img src="{{ asset('img/logos/webflow.svg') }}" class="w-full mb-2" alt="Logo Webflow">
                    <p class="mt-2 text-sm italic text-center">
                        Logo Webflow
                    </p>
                </div>
            </div>
        </div>
        <h4 class="pt-8 text-lg" id="landing-page-site-vitrine">
            Landing page & site vitrine
        </h4>
        <div class="w-10 h-1 my-2 rounded bg-blue"></div>
        <div class="gap-16 lg:columns-2">
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
        <h4 class="pt-8 text-lg" id="enregistrements-cms">
            Enregistrements CMS
        </h4>
        <div class="w-10 h-1 my-2 rounded bg-blue"></div>
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
        <h4 class="pt-8 text-lg" id="site-ecommerce">
            Sites e-commerce
        </h4>
        <div class="w-10 h-1 my-2 rounded bg-blue"></div>
        <p>
            Pour les boutiques en ligne, Webflow propose un système simplifié pour la gestion des produits mais impose une commission à la vente (2% du montant de chaque vente pour l’offre la plus attractive). 
        </p>
        <h3 class="pt-16 text-2xl" id="accompagnement">
            Mon accompagnement
        </h3>
        <div class="w-20 h-1 my-2 rounded bg-blue"></div>
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
    </div>
    <div class="pt-16" id="contact">
        @include('elements.contact')
    </div>
@endsection
