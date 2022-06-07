<div id="contact" class="relative bg-white px-8 lg:px-16 py-16 lg:py-24 grid lg:grid-cols-2 gap-4">
    <div class="container relative">
        <div class="z-10">
            <h2 class="text-orange text-4xl mb-6">
                Et si on discutait de votre projet ?
            </h2>
            <p class="text-gray-800">
                Pour toute demande d'information, merci de renseigner ce formulaire de contact, je reviendrai vers vous dans les plus brefs delais.
            </p>
        </div>
        <img src="{{ asset('img/illustrations/letter-box.svg')}}" alt="Boite aux lettres" title="Envoyer un message" width="568" height="292" class="w-full lg:h-2/4 mx-auto my-12 lg:my-0 lg:absolute x-center top-1/4 z-0 "/>
    </div>
    <x-contact-form />
</div>
