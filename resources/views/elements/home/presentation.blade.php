<section id="presentation" class="pt-24 -mt-24">
    <div class="container flex flex-col mx-auto">
        <div class="flex flex-col items-center gap-12 mt-12 md:gap-16 sm:flex-row sm:items-start">
            <div class="lg:sticky inline-flex items-center justify-center rounded-full w-100 top-24">
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
                    <div data-element="line-vertical"
                        class="absolute w-[1px] top-1/2 h-[150%] -translate-y-1/2 right-0 bg-gradient-to-b  ">
                    </div>
                </div>
            </div>
            <div
                class="border-b border-gray sm:pl-8 sm:pb-8 md:pl-16 md:pb-16 sm:border-l sm:mt-0 sm:text-left">
                <div class="flex flex-col justify-center lg:justify-start items-center gap-8 md:flex-row">
                    <div class="w-18 md:w-12 rotate-45">
                        @include('elements.icon.hand-check')
                    </div>
                    <p class="text-3xl font-bold font-title md:text-4xl text-center lg:text-left">Vous avez frappé à la bonne porte</p>
                </div>
                <p class="my-4 leading-relaxed text-md">
                    Je suis <b class="text-yellow">Matthieu</b>, développeur d'<b class="text-yellow">applications web</b> et de <b class="text-yellow">sites CMS</b> depuis 10 ans sur la région
                    bordelaise.<br /><br />
                    Après plusieurs années en agence de communication et dans des entreprises spécialisées, j'ai acquis
                    un
                    <a href="#competences" @click.prevent="scrollToTarget('#competences')"
                        class="underline text-yellow">savoir-faire technique</a> et <b>une expertise</b> dans la réalisation et la maintenance d'applications web.
                    <br /><br />
                    Je vous accompage dans votre projet afin de trouver et mettre en place <b class="text-yellow">les meilleures solutions techniques</b> en prenant en compte vos enjeux métier.
                    <br /><br />
                <div class="grid gap-4 lg:grid-cols-3">
                    <x-button.secondary href="#competences" @click.prevent="scrollToTarget('#competences')"
                        title="Ce que propose updaz">
                        Savoir-faire
                    </x-button.secondary>
                    <x-button.secondary href="#references" @click.prevent="scrollToTarget('#references')"
                        title="Références Updaz">
                        Références
                    </x-button.secondary>
                    <x-button.primary href="#contact" title="Vous avez des questions ?"
                        @click.prevent="scrollToTarget('#contact')">
                        J'ai un projet web
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
