# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

- **Primaire :** dirigeants et responsables de PME/ETI (Bordeaux, Gironde, puis toute la France à distance) qui ont un processus métier à outiller : CRM, outil interne, extranet, API, back-office. Souvent non techniques ; ils cherchent un interlocuteur fiable pour créer, ou reprendre une application Laravel existante dont le développeur n'est plus disponible.
- **Secondaires :** e-commerçants en quête d'une boutique sur mesure (B2B, migration Prestashop/Shopify) ; entreprises qui veulent un site vitrine Webflow géré en autonomie.
- **Lecteurs du blog :** visiteurs venus de la recherche organique sur Laravel, e-commerce, IA.

## Product Purpose

Site vitrine et d'acquisition d'UpDaz, activité freelance de Matthieu Dazord, développeur web à Bordeaux depuis plus de 10 ans. Il présente les offres, apporte la preuve (références, avis, étude de cas, certification) et convertit en prise de contact via le formulaire. Succès : demandes de contact qualifiées, en priorité pour des applications Laravel sur mesure.

## Positioning

- **Offre prioritaire : applications web Laravel sur mesure** (création, reprise, maintenance, intégration d'IA). Webflow et e-commerce sont des offres complémentaires.
- Un développeur seul, interlocuteur direct du cadrage à la maintenance, avec un passé en agence (AWAM) et en entreprise (KAZoART).
- Code propriété du client, sans abonnement par utilisateur ni verrou d'éditeur.
- IA appliquée d'abord à son propre outil : le blog du site est alimenté par des agents IA Laravel (veille, sujets, brouillons) avec validation humaine avant publication.

## Operating Context

- Laravel 12 (structure Laravel 10), vues Blade, Tailwind CSS v4, Alpine.js, Vite. Admin Filament v4 (`/admin`) pour articles, catégories, avis, sources.
- Pages : accueil, `/application-web-bordeaux`, `/application-web-bordeaux/e-commerce-sur-mesure`, `/webflow-bordeaux`, `/articles` (catégories + articles), mentions légales.
- Contact : formulaire POST `/contact` (reCAPTCHA, throttle), pas de page contact dédiée.
- Pipeline blog : commandes planifiées (`WeeklyBlogPipeline`, `RunTopicStep`, `ReviseArticle`…), validation via Discord.

## Capabilities and Constraints

- **SEO local Bordeaux :** URLs, titres, données structurées (schema `Service`, articles) et contenus ciblés « Bordeaux / Gironde » à préserver ; redirections 301 historiques à conserver.
- **Performance :** le score Lighthouse (`npm run lighthouse`) ne doit pas régresser.
- **Stack légère :** Blade + Tailwind v4 + Alpine uniquement, aucun framework JS ajouté.
- Langue du site : français uniquement.

## Brand Commitments

- Nom : UpDaz (logos dans `public/img/logo*.{svg,png}`).
- Voix : **vouvoiement partout**, à la première personne (« je »), ton expert mais direct et concret. Le tutoiement de la FAQ de l'accueil est une incohérence à corriger.

## Evidence on Hand

- Avis clients (modèle `Review`, plateformes dont Google), affichés sur l'accueil et en étude de cas.
- Étude de cas Solart (maison de ventes aux enchères bordelaise, 2 mois jusqu'à la mise en ligne, stack TALL + Filament).
- Références : PadelReference (e-commerce sur mesure), Mostiglass, travaux en équipe chez AWAM (Khassani Swimwear, Neorev, Artecosy, Pôle Axelera, Maison Aubertin, Popsgym, SBFM Grillage) et KAZoART (Blooming Ladies, KAZoART Pro). Visuels dans `public/img/references`, `public/img/logos`, `public/img/screenshoots`.
- Certification Opquast niveau avancé (`public/img/label-opquast-avance.*`).
- Photo de profil (`public/img/profile.webp`, `avatar.jpg`).
- Absences : aucun tarif public chiffré, aucun chiffre de clientèle ou benchmark de performance. Ne pas en inventer.

## Product Principles

1. Laravel d'abord : chaque surface doit pouvoir mener vers l'offre application web sur mesure.
2. La preuve avant la promesse : références, avis et étude de cas réels plutôt que des affirmations.
3. Un interlocuteur, pas une agence : parler en « je », de façon concrète et sans jargon pour un dirigeant non technique.
4. Montrer la qualité qu'on vend : le site lui-même doit être rapide, accessible et bien référencé.

## Accessibility & Inclusion

Le site doit incarner la certification Opquast : respect vérifiable des bonnes pratiques qualité web (accessibilité, performance, SEO, expérience utilisateur), avec WCAG 2.2 AA comme plancher.
