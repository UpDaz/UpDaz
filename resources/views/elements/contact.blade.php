<div class="container mx-auto relative mb-6">
    <div class="z-10">
        <h2 class="text-orange text-4xl mb-6">
            Et si on discutait de votre projet ?
        </h2>
        <p class="text-gray-800">
            Pour toute demande d'information, merci de renseigner le formulaire ci-dessous, je reviendrai vers vous dans les plus brefs délais.
            <br/>
            Si vous souhaitez m'en dire un peu plus sur votre projet avant d'en discuter de vive voix, merci de bien vouloir compléter
            <a href="https://14r0dvle4i4.typeform.com/to/kEyCbkxN" target="_href" class="inline-block bg-blue hover:bg-blue-dark text-white shadow-md px-2 py-1 rounded">le formulaire d'information @include('elements.svg-icons.external-link')</a>.
        </p>
    </div>
</div>
<div class="relative grid md:grid-cols-2 gap-6">
    <div class="hidden md:block">
        @include('elements/illustrations/contact')
    </div>
    <x-contact-form />
    <div class="block md:hidden">
        @include('elements/illustrations/contact')
    </div>
</div>
