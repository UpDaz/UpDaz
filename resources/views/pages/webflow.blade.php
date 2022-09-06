@extends('layouts.default')

@section('content')
    <div class="bg-blue text-white text-center py-16 md:py-20 md:pt-12">
        <h1 class="font-title text-4xl lg:text-6xl font-bold">Landing pages <br/> & sites vitrine</h1>
        <h2 class="text-orange text-xl mt-4 mb-8">via Webflow</h2>
        <div class="container mx-auto text-left">
            <x-breadcrumb :links="['Webflow' => route('webflow')]" />
        </div>
    </div>
    <div class="container mx-auto md:py-24">
        <h3 id="02ff30ee-4d03-4fe8-90aa-8adaf28461c8" class="">Présentation</h3>
        <p id="337638ac-f4de-4ce9-b72d-36421ae823d8" class="">Webflow est une plateforme de création de site internet et de gestion de contenu (CMS) en ligne. 
            Sa particularité est de proposer une expérience “no-code” : la construction de votre site ne nécessite pas de compétences particulières (en théorie), l’ensemble se faisant via une interface graphique.</p><p id="0566e452-202e-4ce3-ae4a-5daac4159e6a" class="">La plateforme propose différentes offres de la plus basique (un site gratuit) sans fonctionnalités poussées mais avec de nombreuses limitations) à la plus poussée (boutique en ligne et enregistrement CMS). </p><p id="76a946bd-1f3f-43df-8c28-b63b198c370f" class="">Fort d’une communauté active, la plateforme propose de nombreux thèmes et  UI Kits (packs d’éléments graphiques à utiliser pour construire son site) pouvant service de base de travail.</p><p id="54c37801-ce8c-4365-9177-1ee1b7b549ef" class="">
        </p>
        <p id="b158049d-e6f1-494f-a7d3-62269e058cee" class="">En plus de la création graphique de votre site, la plateforme s’occupe de l’hébergement et de l’accès à votre site.</p><figure class="block-color-gray_background callout" style="white-space:pre-wrap;display:flex" id="79948f15-202a-40c8-9624-f3c5fe53d2e1"><div style="font-size:1.5em"><span class="icon">💡</span></div><div style="width:100%">L’accès au site se fait via une URL (ex: www.updaz.fr).
            Dans sa version Starter, Webflow impose un format d’URL pour accéder au site (ex: updaz.webflow.io), pour obtenir une URL personnalisée, il est nécessaire de souscrire à une offre payante.
            Pour plus d’informations : <a href="https://webflow.com/pricing">https://webflow.com/pricing</a></div></figure><p id="9b9dfc21-a386-49bf-9caf-d700e3e2b0f0" class="">
        </p>
        <h3 id="c8c96c22-0413-4e75-a0e8-3989bf6854f4" class="">Quelle utilisation ?</h3>
        <p id="a17111c7-1a65-4b64-8899-794420feaedd" class="">3 types de sites sont proposés par la plateforme : </p>
        <ul id="1f07dbb8-ba3f-439b-a922-370588388d85" class="bulleted-list">
            <li style="list-style-type:disc">Site vitrine</li>
        </ul><ul id="91668b08-afea-4b82-bc63-c35858120cce" class="bulleted-list">
            <li style="list-style-type:disc">Site avec enregistrements CMS</li></ul><ul id="03d4c386-bf63-4c9d-a044-a0ad2b379bf5" class="bulleted-list"><li style="list-style-type:disc">Site E-commerce</li></ul><hr id="b264246c-af71-4522-aaab-4a706c3f5062"/><p id="dd258edf-e47b-43fd-a632-a79d7391ef1a" class="">Le site vitrine correspond à un site dans sa version la plus simple : un ensemble de pages est créé (accueil, présentation de l’équipe, contact, etc) sur lequel du contenu est ajouté (textes, images) et personnalisé avant d’être mis en ligne.
            De base Webflow propose d’intégrer des formulaires (dont la principale utilisation sera le formulaire de contact) qu’il est possible personnaliser en ajoutant différents champs.</p><figure class="block-color-gray_background callout" style="white-space:pre-wrap;display:flex" id="eba8c343-0a57-4c12-a3d0-85cd11d4e3fd"><div style="font-size:1.5em"><span class="icon">💡</span></div><div style="width:100%">En fonction de l’offre souscrite auprès de Webflow, des limitations sont mise en place. 
            Dans sa version la plus standard le formulaire ne peut être soumis que 50 fois en tout et pour tout.
            Pour plus d’informations : <a href="https://webflow.com/pricing">https://webflow.com/pricing</a></div></figure><p id="bd7e66e6-30f7-4561-8035-bc35042e84f8" class="">Ce type de site est parfaitement adapté pour vous accompagner au démarrage de votre projet, vous permettant d’accéder à un outils de communication puissant et accessible.</p><hr id="c05f59c7-ce77-4962-9213-de7150e181f6"/><p id="4e35214c-865f-4c3e-a63d-857e437a1fe3" class="">La version avec enregistrement CMS permet d’ajouter un système de base de données simplifié. 
            Ces enregistrement peuvent être appelés et affichés de différentes manière sur le site. Par exemple si votre site propose une section blog, il est possible définir des articles (illustration, texte d’introduction et contenu) qui seront appelés sous forme de vignettes sur la pages d’accueil (illustration et texte d’introduction) et posséderont en plus une page dédiées (illustration, texte d’introduction et contenu. Les textes de l’article et son image sont centralisé dans une enregistrement CMS qui est réutilisé lorsque nécessaire évitant d’avoir à dupliquer manuellement du contenu à plusieurs endroit sur le site.</p><p id="e149d83d-b68e-4279-819c-63c37bb546c4" class="">Cette fonctionnalité permet d’optimiser les informations du site ainsi que leur gestion.</p><figure class="block-color-gray_background callout" style="white-space:pre-wrap;display:flex" id="bb35cca4-1a27-4905-ac30-512bb0c77755"><div style="font-size:1.5em"><span class="icon">💡</span></div><div style="width:100%">En fonction de l’offre souscrite, le nombre d’enregistrement CMS est plus ou moins limité.</div></figure><hr id="ee64e915-1f18-4608-baec-712c26ca3eb6"/><p id="305a6c03-5fda-4608-b3bb-2aa31fb292ad" class="">Pour les sites E-commerce, Webflow propose un système simplifié pour les gestion des produits, ainsi qu’une commission à la vente (2% pour l’offre la plus attractive). </p><h3 id="654e9a00-5d6c-4c60-a457-582bb9e7ff4d" class="">Mon accompagnement</h3><p id="7bd17e1b-61f8-4ef0-990a-69121c2f31a0" class="">Bien que Webflow propose une approche simplifiée, il est important de comprendre que votre site fonctionnera de la même manière que n’importe quelle autre site et sera régis par les mêmes règles et contraintes. 
            Sans connaissances dans la création de site internet (que ce soit pour la partie graphique qui impact l’expérience utilisateur, le respect des règles SEO pour améliorer votre positionnement dans les résultats de Google ou la programmation pour optimiser vos enregistrements CMS), il est difficile et chronophage d’obtenir un résultat en adéquation avec vos attentes.</p><p id="c0ebf961-cdc5-4c9e-a6ef-45eb71e22c4e" class="">
        </p>
        <p id="1623502c-695a-4b65-881f-22e2308e45f1" class="">Je vous propose donc d’échanger sur votre demande, pour trouver une offre correspondant à vos besoin avec un accompagnement sur mesure.</p><p id="4830e05c-af7c-4c15-80ee-93d50091565b" class="">
        </p>
        <p id="b5975bbd-58b1-43b5-b4a3-60db561e9abb" class="">Cout : 1000€ création site sur une base thème pages avec optimisations UX et SEO + Cout des options Webflow souscrites</p><ul id="684cecf4-de47-4b66-8f35-1cb8236c4328" class="bulleted-list"><li style="list-style-type:disc">500€ par gestion des enregistrements CMS</li></ul><p id="0274ce48-05f7-490e-8d6b-b3470c00d35f" class="">
        </p>
    </div>
@endsection
