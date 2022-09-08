<div id="contact" class="relative grid md:grid-cols-2 gap-6">
    <div class="container mx-auto relative">
        <div class="z-10">
            <h2 class="text-orange text-4xl mb-6">
                Et si on discutait de votre projet ?
            </h2>
            <div class="block md:hidden w-full mx-auto my-12">
                @include('elements/illustrations/contact')
            </div>
            <p class="text-gray-800">
                Pour toute demande d'information, merci de renseigner ce formulaire de contact, je reviendrai vers vous dans les plus brefs délais.
            </p>
        </div>
        <div class="hidden md:block w-full md:h-96 mx-auto my-12 md:mt-8 md:mb-0  ">
            @include('elements/illustrations/contact')
        </div>
    </div>
    <x-contact-form />
</div>
