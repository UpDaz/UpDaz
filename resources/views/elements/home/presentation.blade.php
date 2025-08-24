<section id="presentation" class="border-t border-gray">
    <div class="container flex flex-col mx-auto">
        <div class="">
            <div class="flex flex-col mt-10 sm:flex-row">
                <div class="sm:w-1/4">
                    <div class="sticky inline-flex items-center justify-center rounded-full w-100 top-24">
                        <div class="relative">
                            @include('elements.html.webp-image', [
                                'source' => asset('img/profile.jpg'),
                                'alt' => 'Photo de profil Matthieu UpDaz',
                                'width' => '253',
                                'height' => '253',
                                'class' => 'object-cover object-center rounded',
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
                <div
                    class="border-y border-gray sm:w-3/4 sm:pl-16 sm:py-16 sm:border-l sm:border-t-0 sm:mt-0 sm:text-left">
                    <div class="flex items-center gap-8">
                        <p class="mb-2 text-2xl font-title md:text-3xl">Bienvenue chez <span
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
                        <span class="font-bold">savoir-faire technique</span> et <b>une expertise</b> dans les
                        technologies du web.
                        <br /><br />
                        Face à la multitude de possibilités et d'options proposées pour la <b>conception d'un site
                            web</b>, je vous
                        accompagne dans votre projet afin de <b>trouver les meilleures solutions</b> à vos différentes
                        problématiques.
                        <br /><br />
                        <div class="grid gap-4 lg:grid-cols-3">
                            <x-button.secondary href="#services" @click.prevent="scrollToTarget('#services')"
                                title="Ce que propose updaz">
                                Ce que je propose
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
