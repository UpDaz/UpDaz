<form x-data="contactForm" id="contact-form" method="POST" action="{{ route('contact') }}" @submit.prevent="submitForm()" class="flex flex-col gap-4 mb-4">
    @csrf
    @if (request('contact') === 'envoye')
        <p class="flex gap-4 text-lg" role="status">
            <span class="w-8">
                @include('elements.icon.check-square')
            </span>
            J'ai bien reçu votre demande, je reviendrai vers vous dans les plus brefs délais.
        </p>
    @endif
    <div class="flex flex-col gap-1">
        <label for="lastname" class="text-sm font-title">Nom*</label>
        <input name="lastname"
            class="w-full px-3 py-2 leading-tight border appearance-none text-blue placeholder-gray bg-white"
            id="lastname" type="text" autocomplete="family-name" maxlength="100" required>
    </div>
    <div class="flex flex-col gap-1">
        <label for="firstname" class="text-sm font-title">Prénom*</label>
        <input name="firstname"
            class="w-full px-3 py-2 leading-tight border appearance-none text-blue placeholder-gray bg-white"
            id="firstname" type="text" autocomplete="given-name" maxlength="100" required>
    </div>
    <div class="flex flex-col gap-1">
        <label for="email" class="text-sm font-title">Email*</label>
        <input name="email"
            class="w-full px-3 py-2 leading-tight border appearance-none text-blue placeholder-gray bg-white"
            id="email" type="email" autocomplete="email" maxlength="255" required>
    </div>
    <div class="flex flex-col gap-1">
        <label for="phone" class="text-sm font-title">Téléphone</label>
        <input name="phone"
            class="w-full px-3 py-2 leading-tight border appearance-none text-blue placeholder-gray bg-white"
            id="phone" type="tel" autocomplete="tel" maxlength="30">
    </div>
    <div class="flex flex-col gap-1">
        <label for="message" class="text-sm font-title">Message*</label>
        <textarea name="message" id="message" cols="30" rows="10" maxlength="5000" required
            class="w-full px-3 py-2 leading-tight border appearance-none text-blue placeholder-gray bg-white"></textarea>
    </div>
    <div class="absolute -left-[9999px]" aria-hidden="true">
        <label for="company">Ne pas remplir ce champ</label>
        <input type="text" name="company" id="company" tabindex="-1" autocomplete="off">
    </div>
    <div class="flex flex-col gap-4">
        <p x-show="submitting" class="flex gap-4 text-lg" role="status">
            <img src="{{ asset('img/loader.svg') }}" class="w-8 animate-spin" alt="" />
            Envoi en cours, merci de patienter
        </p>
        <x-button.primary tag="button" x-show="!submitting && !success" type="submit">
            Envoyer mon message
        </x-button.primary>
        <p x-show="!submitting && success" class="flex gap-4 text-lg" role="status">
            <span class="w-8">
                @include('elements.icon.check-square')
            </span>
            J'ai bien reçu votre demande, je reviendrai vers vous dans les plus brefs délais.
        </p>
        <p x-show="error" class="flex items-start gap-4" role="alert">
            <span class="w-8">
                @include('elements.icon.warning')
            </span>
            <span x-show="error === 'throttled'" class="text-lg">
                Trop de messages envoyés en peu de temps. Votre message est conservé : réessayez dans une minute.
            </span>
            <span x-show="error === 'invalid'" class="text-lg">
                Certains champs sont invalides. Vérifiez votre adresse email et la longueur de votre message, puis renvoyez-le.
            </span>
            <span x-show="error === 'failed'" class="text-lg">
                Votre message n'a pas pu être envoyé. Réessayez, ou écrivez-moi directement à <a
                    href="mailto:matthieu@updaz.fr" title="email de contact UpDaz" class="underline">matthieu@updaz.fr</a>
            </span>
        </p>
    </div>
    <p x-show="!submitting && !success" class="text-xs text-white/75">
        * Champs requis
    </p>
</form>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('contactForm', () => ({
            submitting: false,
            success: false,
            error: false,
            submitForm() {
                this.submitting = true;
                this.success = false;
                this.error = false;
                let alpineComponent = this;
                var form = document.getElementById('contact-form');
                var formData = new FormData(form);
                axios({
                    method: "post",
                    url: "{{ route('contact') }}",
                    data: formData,
                    headers: {
                        "Content-Type": "multipart/form-data"
                    },
                }).then(response => {
                    alpineComponent.submitting = false;
                    alpineComponent.success = true;
                }).catch(failure => {
                    const status = failure.response ? failure.response.status : null;

                    alpineComponent.submitting = false;
                    alpineComponent.success = false;
                    alpineComponent.error = status === 429 ? 'throttled' : (status === 422 ? 'invalid' : 'failed');
                });
            }
        }))
    });
</script>
