<div id="contact" class="relative bg-white px-8 md:px-16 py-16 md:py-24 grid md:grid-cols-2 gap-4">
    <div class="container mx-auto relative">
        <div class="z-10">
            <h2 class="text-orange text-4xl mb-6">
                Et si on discutait de votre projet ?
            </h2>
            <div class="block md:hidden w-full mx-auto my-12">
                @include('elements/illustrations/letter-box')
            </div>
            <p class="text-gray-800">
                Pour toute demande d'information, merci de renseigner ce formulaire de contact, je reviendrai vers vous dans les plus brefs délais.
            </p>
        </div>
        <div class="hidden md:block w-full md:h-96 mx-auto my-12 md:my-0 top-1/4 z-0 ">
            @include('elements/illustrations/letter-box')
        </div>
    </div>
    <x-contact-form />
</div>
