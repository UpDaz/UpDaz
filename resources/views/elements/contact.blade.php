<section class="relative">
    <div class="container mx-auto">
        <div class="grid items-start justify-start gap-8 md:grid-cols-2 md:gap-16">
            <div class="flex flex-col gap-4 md:gap-8">
                <div class="flex items-center justify-start gap-8">
                    <div class="w-18 md:w-20">
                        @include('elements.icon.discussion-question')
                    </div>
                    <h2 class="text-3xl sm:text-4xl">Vous avez un projet ? Une question ?</h2>
                </div>
                <p>Envoyez-moi un message grâce à ce formulaire et je vous répondrai dans les plus brefs délais.</p>
                <div class="text-blue-dark hidden lg:block absolute bottom-1/3 *:w-full *:h-auto w-1/10">
                    @include('elements.icon.scribble')
                </div>
            </div>
            <div>
                <x-contact-form />
            </div>
        </div>
    </div>
</section>
