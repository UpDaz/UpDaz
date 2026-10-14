---
name: UpDaz
description: Développeur Laravel et Webflow à Bordeaux, un site dessiné comme un plan d'atelier.
colors:
  blue-gironde: "#2E5676"
  blue-gironde-deep: "#24445C"
  yellow-bordelais: "#EBB100"
  paper-white: "#F5F7FA"
  ink-dark: "#2F3542"
  hairline-gray: "#98abb8"
typography:
  display:
    fontFamily: "Space Mono, monospace, sans-serif"
    fontSize: "3rem"
    fontWeight: 700
    lineHeight: 1.2
    letterSpacing: "normal"
  headline:
    fontFamily: "Space Mono, monospace, sans-serif"
    fontSize: "1.875rem"
    fontWeight: 700
    lineHeight: 1.2
  title:
    fontFamily: "Space Mono, monospace, sans-serif"
    fontSize: "1.25rem"
    fontWeight: 700
    lineHeight: 1.2
  body:
    fontFamily: "Fira Sans, sans-serif"
    fontSize: "1rem"
    fontWeight: 300
    lineHeight: 1.5
  label:
    fontFamily: "Space Mono, monospace, sans-serif"
    fontSize: "0.875rem"
    fontWeight: 400
    lineHeight: 1.25
rounded:
  none: "0px"
spacing:
  xs: "8px"
  sm: "16px"
  md: "32px"
  lg: "48px"
  section: "64px"
components:
  button-primary:
    backgroundColor: "transparent"
    textColor: "{colors.paper-white}"
    typography: "{typography.label}"
    rounded: "{rounded.none}"
  button-primary-hover:
    textColor: "{colors.yellow-bordelais}"
  button-secondary:
    backgroundColor: "transparent"
    textColor: "{colors.paper-white}"
    rounded: "{rounded.none}"
  button-secondary-hover:
    textColor: "{colors.yellow-bordelais}"
  input-text:
    backgroundColor: "{colors.paper-white}"
    textColor: "{colors.blue-gironde}"
    rounded: "{rounded.none}"
    padding: "8px 12px"
  code-inline:
    backgroundColor: "{colors.ink-dark}"
    textColor: "{colors.paper-white}"
    padding: "0 8px"
---

# Design System: UpDaz

## Overview

**Creative North Star: "Le Plan d'atelier"**

Le site se lit comme un tirage de plan posé sur la table d'un développeur-artisan. Le fond est un papier bleu profond, dégradé en diagonale du Bleu Gironde vers sa version sombre. Ses deux bords sont tenus par des bandes hachurées qui cadrent la page comme une feuille de dessin technique. Tout ce qui structure (cadres, séparateurs, soulignements) est tracé au filet gris fin qui s'efface aux extrémités, comme un trait de crayon qui dépasse de la cote. Les sections sont séparées par des repères d'échelle (graduations, petits blocs hachurés, mention « 1x1 » pivotée) plutôt que par des fonds de couleur.

Sur cette rigueur de plan, une seule main humaine : le Jaune bordelais, tracé à main levée sous les boutons et posé sur les liens qui comptent. La typographie suit la même logique : Space Mono, chasse fixe, pour tout ce qui est titre, étiquette ou action (la voix de l'outil) ; Fira Sans en graisse légère pour le texte courant (la voix de l'homme qui explique).

Le système est plat, à angles vifs, monochrome bleu avec un seul accent. La densité est aérée : de grands espaces entre sections, un contenu centré dans un conteneur à marge latérale généreuse.

**Key Characteristics:**
- Fond bleu dégradé (135°) bordé de bandes hachurées verticales sur les deux côtés.
- Filets gris de 1 px qui s'effacent aux extrémités et débordent de leur cadre (110 à 125 %).
- Séparateurs de section en forme de règle graduée, avec annotation d'échelle.
- Titres et actions en Space Mono ; texte courant en Fira Sans 300.
- Un seul accent : le jaune, en soulignement manuscrit et en survol.
- Aucun arrondi, aucune ombre, aucun aplat de carte.

## Colors

Un camaïeu de bleu nuit sur lequel un unique jaune joue le rôle du surligneur.

### Primary
- **Bleu Gironde** (#2E5676) : le papier du plan. Départ du dégradé de fond, fond des hachures, survol des lignes d'accordéon, fond des pastilles d'initiales dans les avis.
- **Bleu Gironde profond** (#24445C) : arrivée du dégradé de fond et trame foncée des bandes hachurées.

### Secondary
- **Jaune bordelais** (#EBB100) : l'annotation à la main. Soulignement manuscrit des boutons, liens clés dans le texte, catégories d'articles, étoiles des avis, état de survol des boutons. Jamais en aplat de fond.

### Neutral
- **Blanc papier** (#F5F7FA) : couleur du texte courant et des titres sur le fond bleu ; fond des champs de formulaire.
- **Gris filet** (#98abb8) : tous les traits (filets en fondu, bordures de tableau, graduations, hachures) et le texte secondaire (dates, méta des avis).
- **Encre** (#2F3542) : fond des blocs de code dans les articles.

### Named Rules
**The Highlighter Rule.** Le Jaune bordelais annote, il ne remplit pas. Il apparaît en trait, en texte ou en icône, jamais comme fond de bouton, de carte ou de section.

**The Blue Paper Rule.** Toute surface est le fond bleu dégradé. On ne crée pas de cartes en aplat clair ; une zone se délimite par des filets, pas par un changement de fond.

## Typography

**Display Font:** Space Mono (avec monospace, sans-serif)
**Body Font:** Fira Sans (avec sans-serif)

**Character:** Une machine et une main. Space Mono donne la précision d'un cartouche de plan et la culture du code ; Fira Sans en graisse 300 garde le texte léger et lisible, comme une note de conception. Les deux polices sont auto-hébergées (sous-ensemble latin, `font-display: swap`).

### Hierarchy
- **Display** (700, 3rem / 2.25rem dans le héros, 1.2) : H1 de page.
- **Headline** (700, 1.875rem, 1.2) : titres de section (H2).
- **Title** (700, 1.25rem, 1.2) : titres de bloc, de compétence, d'article en liste (limité à 2 lignes).
- **Body** (300, 1rem, 1.5) : texte courant ; le chapô du héros monte à 1.125rem. `<b>` reste en graisse normale.
- **Label** (400, 0.875rem, Space Mono) : libellés de formulaire, dates, catégories, boutons compacts ; les boutons principaux passent en capitales à 1.125rem.

### Named Rules
**The Mono Voice Rule.** Tout ce qui nomme ou déclenche (titre, libellé, bouton, date, annotation d'échelle) est en Space Mono. Tout ce qui explique est en Fira Sans.

## Layout

Une colonne centrée dans le conteneur Tailwind, avec 32 px de marge intérieure (`px-8`) et un débordement masqué. Sur grand écran, les sections passent en deux colonnes (texte / illustration, colonne de sommaire / contenu) ; sous `lg`, tout s'empile et le menu bascule en version mobile.

Le rythme vertical est large : 64 px entre sections de page (`gap-16`), 32 px entre éléments d'un même bloc (`gap-8`), 16 px et 8 px pour les groupes serrés. Les blocs de contenu respirent avec 32 à 48 px de marge intérieure (`p-8 md:p-12`). Les bandes hachurées latérales font 8 px de large sur mobile et 16 px à partir de `md`.

Chaque section est séparée par un séparateur de règle (variantes gauche, droite, centre, extérieur) : un bloc hachuré sur une partie de la grille, un filet sur le reste, une graduation au-dessus et une annotation « 1x1 » pivotée.

## Elevation & Depth

Le système est entièrement plat. La profondeur ne vient ni des ombres ni des fonds superposés : elle vient du dessin. Les cadres sont faits de quatre filets indépendants qui dépassent du bloc et s'effacent aux extrémités, ce qui suggère un tracé de construction plutôt qu'un objet posé. Le seul changement de plan admis est le survol, qui éclaircit une ligne en Bleu Gironde.

### Named Rules
**The Construction Line Rule.** Un cadre se dessine avec des filets gris de 1 px en dégradé transparent → gris → transparent, qui débordent de 10 à 25 % de leur bloc. Pas de `border` pleine, pas de `box-shadow`.

## Shapes

Angles vifs partout (0 px) : boutons, champs, cadres, pastilles d'initiales, illustrations. Les seules courbes sont tracées à la main : le double soulignement des boutons principaux et le trait simple des boutons secondaires, en SVG irrégulier, comme un coup de feutre. Les icônes sont au trait (style Heroicons outline, 1.5 px).

## Components

### Buttons
Des actions qui ressemblent à un mot souligné sur le plan, pas à des pastilles.
- **Shape:** aucun fond, aucune bordure, angles vifs (0 px).
- **Primary:** texte Space Mono en capitales (1.125rem, 0.875rem en version compacte sur desktop), Blanc papier, centré, pleine largeur de son conteneur ; sous le texte, un double trait manuscrit en Jaune bordelais (76 × 11 px).
- **Hover / Focus:** le texte passe en Jaune bordelais.
- **Secondary:** texte Fira Sans 1rem, suivi d'un trait manuscrit simple (73 × 3 px) aligné à droite sur desktop. Sert aux « Lire l'article », « En savoir plus ».

### Cards / Containers
- **Corner Style:** angles vifs (0 px).
- **Background:** transparent, le fond bleu reste visible.
- **Shadow Strategy:** aucune (voir Elevation & Depth).
- **Border:** filets de construction en fondu sur 2 côtés (avis, articles) ou 4 côtés (références, accordéons), qui débordent de 10 à 25 %.
- **Internal Padding:** 24 à 48 px.

### Inputs / Fields
- **Style:** fond Blanc papier, texte Bleu Gironde, bordure 1 px, angles vifs, 8 × 12 px de marge intérieure ; libellé au-dessus en Space Mono 0.875rem.
- **Focus:** contour Jaune bordelais de 2 px, décalé de 2 px (règle `:focus-visible` globale).
- **Error / Disabled:** les messages d'état sont du texte accompagné d'une icône au trait, sans couleur d'alerte dédiée.

### Navigation
- **Style:** liens Fira Sans 0.875rem en Blanc papier, soulignés au survol par un filet gris en fondu ; page courante marquée par `aria-current`. Le dernier élément est un bouton principal compact « J'ai un projet ».
- **Mobile:** sous `lg`, menu dédié en plein écran avec liens empilés en 1.125rem.

### Accordion (FAQ)
Une ligne de question encadrée de quatre filets de construction, titre en Space Mono, flèche au trait qui pivote de −90° quand c'est fermé. Survol en Bleu Gironde. À l'ouverture, un trait manuscrit centré marque le haut de la réponse.

### Ruler Separator (signature)
Le séparateur entre sections : une grille de 4 colonnes où un bloc hachuré de 10 px de haut occupe une colonne, un filet gris occupe les autres, surmonté d'une graduation (filet avec deux taquets de 8 px) et d'une annotation « 1x1 » en Space Mono 0.75rem pivotée de −90°. Quatre variantes : gauche, droite, centre, extérieur.

### Review
Pastille carrée d'initiales en Bleu Gironde, nom en semi-gras, étoiles en Jaune bordelais (Gris filet à 30 % pour les étoiles vides), logo de la plateforme à droite, citation en italique entre guillemets français, filets de construction en haut et en bas.

## Do's and Don'ts

### Do:
- **Do** délimiter chaque zone avec des filets gris de 1 px en dégradé transparent → #98abb8 → transparent, qui débordent de leur bloc.
- **Do** séparer les sections de page par un séparateur de règle et 64 px d'espace.
- **Do** réserver le Jaune bordelais (#EBB100) aux traits manuscrits, aux liens clés, aux catégories, aux étoiles et aux survols.
- **Do** composer titres, libellés, dates et boutons en Space Mono, et le texte courant en Fira Sans 300.
- **Do** garder un indicateur de focus visible sur chaque élément interactif (exigence Opquast / WCAG 2.2 AA du produit) : contour Jaune bordelais de 2 px, jamais retiré par `outline-none`.

### Don't:
- **Don't** ajouter d'ombre portée (`box-shadow`, `shadow-*`) : le système est plat, la profondeur passe par les filets.
- **Don't** arrondir les coins (`rounded-*`) des boutons, champs, cadres ou pastilles : tout est à angles vifs.
- **Don't** utiliser de bordure CSS pleine pour encadrer un bloc : les cadres sont des filets de construction indépendants et en fondu. Les tableaux, citations et le code inline arrondi du contenu d'article sont des écarts existants, pas des modèles.
- **Don't** poser le Jaune bordelais en aplat de fond.
- **Don't** introduire un fond de carte clair ou un aplat de section différent du fond bleu dégradé.
