<section id="presentation" class="pt-24 -mt-24">
    <div class="container flex flex-col mx-auto">
        <div class="flex flex-col items-center gap-8 mt-10 md:gap-16 sm:flex-row sm:items-start">
            <div class="border-b border-gray sm:pl-8 sm:pb-8 md:pl-16 md:pb-16 sm:border-l sm:mt-0 sm:text-left">
                <div class="flex flex-row-reverse items-center gap-8 sm:flex-row">
                    <p class="text-3xl font-bold font-title md:text-3xl"><span class="text-yellow">Webflow</span>
                        qu'est-ce que c'est ?</p>
                    <div class="self-end w-12">
                        @include('elements.icon.question-mark')
                    </div>
                </div>
                <p class="my-4 leading-relaxed text-md">
                    Webflow est une plateforme de création de site internet et de gestion de contenu (CMS) en ligne.
                    <br />
                    Lancée en 2013 afin de répondre aux problématiques de qualité de site proposés par les plateformes
                    type Wix et de complexité de prise en main des CMS type Wordpress. Webflow se veut <span
                        class="font-bold">intuitif, flexible et performant</span>.
                </p>
                <p class="my-4 leading-relaxed text-md">
                    Sa particularité est de proposer une <span class="font-bold">expérience “no-code”</span> : la
                    construction de votre site ne nécessite pas de connaissances poussées dans le développement web.
                    <br />
                    Proposant une interface similaire aux logiciels de la suite Adobe (Illustrator, Photoshop, etc), les
                    différents éléments du site se mettent en place via un système de
                    <x-tooltip color="#001A9E">
                        <x-slot:message>
                            Utilisation du glisser-déposer en utilisant la souris de votre ordinateur.
                        </x-slot>
                        <x-slot:content>
                            <i>drag-and-drop</i>
                        </x-slot>
                    </x-tooltip>
                    .
                    <br />
                    Chaque élément peut être par la suite personnalisé en agissant sur ses caractéristiques.
                </p>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    document.addEventListener('alpine:init', () => {
        Alpine.data('presentation', () => ({
            scrollToTarget: function(target) {
                window.scrollTo({
                    top: document.querySelector(target).offsetTop,
                    left: 0,
                    behavior: 'smooth'
                });
            }
        }))
    })
</script>
