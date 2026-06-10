<section class="-mb-18">
    <div class="flex items-center justify-center relative py-16 pb-8 lg:pt-8 lg:min-h-[80vh]">
        <div class="container flex flex-col items-center gap-20 mx-auto lg:flex-row">
            <div class="flex flex-col gap-8 lg:grow xl:w-1/2 md:items-start md:text-left">
                <div class="flex items-center gap-8 md:block">
                    <h1 class="text-5xl font-bold text-white font-title txt-rotate">
                        Artisan de votre<br />application web
                    </h1>
                </div>
                <h2 class="font-text font-light text-lg"><b>UpDaz</b> développe et maintient votre <span
                        class="text-yellow">application
                        web</span>, <span class="text-yellow text-nowrap ">e-commerce</span> et
                    <span class="text-yellow">site web CMS</span> à Bordeaux depuis 10 ans.
                </h2>
                <div class="flex flex-col gap-2">
                    <x-skills.item text="Développement d'applications web avec Laravel" />
                    <x-skills.item text="Création de sites web avec Webflow" />
                    <x-skills.item text="Conseils, gestion de projet, développement web" />
                </div>
                <div class="grid *:w-full gap-4  w-full items-start">
                    <x-button.primary href="#contact" title="UpDaz : formulaire de contact"
                        @click.prevent="scrollToTarget('#contact')" classes="xl:col-span-2">
                        Je souhaite réaliser un site web
                        </x-button-primary>
                </div>
            </div>
            <div class="hidden lg:flex justify-center w-full *:w-full *:h-auto md:w-1/2 *:lg:w-auto *:lg:h-[65vh]">
                @include('elements.home.welcome-illustration')
            </div>
        </div>
    </div>
    @include('elements.reassurance')
</section>
