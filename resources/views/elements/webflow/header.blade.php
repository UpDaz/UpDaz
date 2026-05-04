<section>
    <div class="flex items-center justify-center relative py-16 pb-8 lg:pt-8 lg:min-h-[80vh]">
        <div class="container flex flex-col items-center gap-20 mx-auto md:flex-row">
            <div class="flex flex-col gap-12 lg:flex-grow md:w-1/2 md:items-start md:text-left">
                <div class="flex items-center gap-8 md:block">
                    <h1 class="text-5xl font-bold text-white font-title txt-rotate">
                        Création de site Webflow à Bordeaux
                    </h1>
                </div>
                <p class="font-text">
                    UpDaz vous accompagne pour concevoir un <span class="text-yellow">site CMS, performant et adapté à
                        vos besoins</span>.
                </p>
                <div class="grid *:w-full gap-4 lg:grid-cols-2 w-full">
                    <x-button.secondary href="#presentation" @click.prevent="scrollToTarget('#presentation')"
                        title="Présentation Webflow">
                        À propos de Webflow
                    </x-button.secondary>
                    <x-button.secondary href="#accompagnement" @click.prevent="scrollToTarget('#accompagnement')"
                        title="Accompagnement Webflow">
                        Mon accompagnement
                    </x-button.secondary>
                    <div class="xl:col-span-3">
                        <x-button.primary href="#contact" title="Webflow : formulaire de contact"
                            @click.prevent="scrollToTarget('#contact')" classes="lg:col-span-2 xl:col-span-3">
                            J'ai un projet de site web
                            </x-button-primary>
                    </div>
                </div>
            </div>
            <div class="hidden lg:flex justify-center w-full *:w-full *:h-auto md:w-1/2 *:lg:w-auto *:lg:h-[65vh]">
                @include('elements.webflow.hero-illustration')
            </div>
        </div>
    </div>
    @include('elements.reassurance')
</section>
