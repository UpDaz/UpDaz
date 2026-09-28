<section id="presentation" class="-mt-24 pt-24">
    <div class="container mx-auto flex flex-col">
        <div class="mt-12 flex flex-col items-center gap-12 sm:flex-row sm:items-start md:gap-16">
            <div class="w-100 top-24 inline-flex items-center justify-center rounded-full lg:sticky">
                <div class="relative">
                    @include('elements.html.webp-image', [
                        'source' => asset('img/profile.jpg'),
                        'alt' => 'Photo de profil de Matthieu DAZORD, développeur web freelance à Bordeaux',
                        'width' => '253',
                        'height' => '253',
                        'class' => 'object-cover object-center rounded',
                        'title' => 'Matthieu DAZORD',
                    ])
                    <div data-element="line-horizontal" class="absolute left-1/2 top-0 h-[1px] w-[150%] -translate-x-1/2 bg-gradient-to-r">
                    </div>
                    <div data-element="line-horizontal" class="absolute bottom-0 left-1/2 h-[1px] w-[150%] -translate-x-1/2 bg-gradient-to-r">
                    </div>
                    <div data-element="line-vertical" class="absolute left-0 top-1/2 h-[150%] w-[1px] -translate-y-1/2 bg-gradient-to-b">
                    </div>
                    <div data-element="line-vertical" class="absolute right-0 top-1/2 h-[150%] w-[1px] -translate-y-1/2 bg-gradient-to-b">
                    </div>
                </div>
            </div>
            <div class="sm:mt-0 sm:pb-8 sm:pl-8 sm:text-left md:pb-16 md:pl-16">
                <div class="flex flex-row items-center justify-center gap-8 lg:justify-start">
                    <div class="rotate-45 *:h-auto *:w-12">
                        @include('elements.icon.hand-check')
                    </div>
                    <p class="font-title text-3xl font-bold">Vous avez frappé à la bonne porte</p>
                </div>
                <div class="text-md my-4 leading-relaxed">
                    Je suis <b class="text-yellow">Matthieu DAZORD</b>, développeur d'<b class="text-yellow">applications web</b> et de <b class="text-yellow">sites CMS</b> depuis 10 ans sur la région
                    bordelaise.<br /><br />
                    Après plusieurs années en agence de communication et dans des entreprises spécialisées, j'ai acquis
                    des
                    <a href="#competences" @click.prevent="scrollToTarget('#competences')" class="text-yellow underline">compétences techniques</a> et <b>une expertise</b> dans la réalisation et la maintenance d'applications web.
                    <br /><br />
                    Je vous accompagne dans votre projet afin de trouver et mettre en place <b class="text-yellow">les meilleures solutions techniques</b> en prenant en compte vos enjeux métier.
                    <br /><br />
                    <div class="flex justify-between gap-16 items-center">
                        <div class="grid gap-4 lg:grid-cols-3">
                            <x-button.secondary href="#competences" @click.prevent="scrollToTarget('#competences')" title="Ce que propose updaz">
                                Compétences
                            </x-button.secondary>
                            <x-button.secondary href="#references" @click.prevent="scrollToTarget('#references')" title="Références Updaz">
                                Références
                            </x-button.secondary>
                            <x-button.primary href="#contact" title="Vous avez des questions ?" @click.prevent="scrollToTarget('#contact')">
                                J'ai un projet
                                </x-button-primary>
                        </div>
                        <ul class="flex flex-wrap items-center justify-center gap-4 sm:justify-start" aria-label="Profils de Matthieu DAZORD">
                            <li>
                                <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" rel="me noopener" title="Profil LinkedIn de Matthieu DAZORD">
                                    <img src="{{ asset('img/logos/white/linkedin.svg') }}" width="24" height="24" alt="" loading="lazy">
                                </a>
                            </li>
                            <li>
                                <a href="https://github.com/UpDaz" target="_blank" rel="me noopener" title="Profil GitHub de Matthieu DAZORD">
                                    <img src="{{ asset('img/logos/white/github.svg') }}" width="24" height="24" alt="" loading="lazy">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.malt.fr/profile/matthieudazord" target="_blank" rel="me noopener" title="Profil Malt de Matthieu DAZORD">
                                    <img src="{{ asset('img/logos/white/malt.svg') }}" width="24" height="24" alt="" loading="lazy">
                                </a>
                            </li>
                        </ul>
                    </div>
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
