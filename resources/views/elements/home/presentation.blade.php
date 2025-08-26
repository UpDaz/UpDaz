<section id="presentation">
    <div class="container flex flex-col mx-auto">
        <div class="flex flex-col items-center gap-8 mt-10 md:gap-16 sm:flex-row sm:items-start">
            <div class="sm:w-1/4">
                <div class="sticky inline-flex items-center justify-center rounded-full w-100 top-24">
                    <div class="relative">
                        @include('elements.html.webp-image', [
                            'source' => asset('img/profile.jpg'),
                            'alt' => 'Photo de profil Matthieu UpDaz',
                            'width' => '253',
                            'height' => '253',
                            'class' => 'object-cover object-center rounded',
                            'title' => 'Photo de profile Matthieu',
                        ])
                        <div data-element="line-horizontal"
                            class="absolute h-[1px] left-1/2 w-[150%] -translate-x-1/2 top-0 bg-gradient-to-r  ">
                        </div>
                        <div data-element="line-horizontal"
                            class="absolute h-[1px] left-1/2 w-[150%] -translate-x-1/2 bottom-0 bg-gradient-to-r  ">
                        </div>
                        <div data-element="line-vertical"
                            class="absolute w-[1px] top-1/2 h-[150%] -translate-y-1/2 left-0 bg-gradient-to-b  ">
                        </div>
                        <div
                            data-element="line-vertical"
                            class="absolute w-[1px] top-1/2 h-[150%] -translate-y-1/2 right-0 bg-gradient-to-b  ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-b border-gray sm:w-3/4 sm:pl-8 sm:pb-8 md:pl-16 md:pb-16 sm:border-l sm:mt-0 sm:text-left">
                <div class="flex flex-row-reverse items-center gap-8 sm:flex-row">
                    <p class="text-3xl font-bold font-title md:text-4xl">Bienvenue chez <span
                            class="text-yellow">UpDaz</span></p>
                    <div class="self-end w-16 rotate-45">
                        @include('elements.icon.hand-check')
                    </div>
                </div>
                <p class="my-4 leading-relaxed text-md">
                    Je m'appelle <b>Matthieu</b>, je suis <b>développeur full-stack</b> depuis 8 ans sur la région
                    bordelaise.<br /><br />
                    J’ai eu la chance de concevoir de nombreuses plateformes web de par mon parcours : landing
                    pages, sites
                    vitrines, boutiques en ligne, plateformes sur-mesure…<br />
                    Après plusieurs années en agence de communication et en entreprises spécialisées, j'ai développé
                    un
                    <a href="#competences" @click.prevent="scrollToTarget('#competences')" class="underline">savoir-faire technique</a> et <b>une expertise</b> dans les
                    technologies du web.
                    <br /><br />
                    Face à la multitude de possibilités et d'options proposées pour la <b>conception d'un site
                        web</b>, je vous
                    accompagne dans votre projet afin de <b>trouver les meilleures solutions</b> à vos différentes
                    problématiques.
                    <br /><br />
                <div class="grid gap-4 lg:grid-cols-3">
                    <x-button.secondary href="#competences" @click.prevent="scrollToTarget('#competences')"
                        title="Ce que propose updaz">
                        Compétences
                    </x-button.secondary>
                    <x-button.secondary href="#presentation" @click.prevent="scrollToTarget('#references')"
                        title="Références Updaz">
                        Références
                    </x-button.secondary>
                    <x-button.primary href="#contact" title="Vous avez des questions ?">
                        Vous avez une question ?
                        </x-button-primary>
                </div>
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
