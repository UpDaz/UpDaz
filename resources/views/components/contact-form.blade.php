<form x-data="contactForm" id="contact-form" @submit.prevent="submitForm()" class="flex flex-col gap-4 mb-4">
    <div class="flex flex-col gap-1">
        <label class="text-sm">Nom*</label>
        <input name="lastname"
            class="w-full px-3 py-2 leading-tight border appearance-none text-blue placeholder-gray focus:outline-none focus:shadow"
            id="lastname" type="text" required>
    </div>
    <div class="flex flex-col gap-1">
        <label class="text-sm">Prénom*</label>
        <input name="firstname"
            class="w-full px-3 py-2 leading-tight border appearance-none text-blue placeholder-gray focus:outline-none focus:shadow"
            id="firstname" type="text" required>
    </div>
    <div class="flex flex-col gap-1">
        <label class="text-sm">Email*</label>
        <input name="email"
            class="w-full px-3 py-2 leading-tight border appearance-none text-blue placeholder-gray focus:outline-none focus:shadow"
            id="email" type="email" required>
    </div>
    <div class="flex flex-col gap-1">
        <label class="text-sm">Téléphone*</label>
        <input name="phone"
            class="w-full px-3 py-2 leading-tight border appearance-none text-blue placeholder-gray focus:outline-none focus:shadow"
            id="phone" type="text" required>
    </div>
    <div class="flex flex-col gap-1">
        <label class="text-sm">Message*</label>
        <textarea name="message" id="message" cols="30" rows="10"
            class="w-full px-3 py-2 leading-tight border appearance-none text-blue placeholder-gray focus:outline-none focus:shadow"></textarea>
    </div>
    <div class="flex flex-col gap-4">
        <p x-show="submitting" class="flex gap-4 text-lg">
            <img src="{{ asset('img/loader.svg') }}" class="w-8 animate-spin" alt="Loader" title="Chargement" />
            Envoi en cours, merci de patienter
        </p>
        <x-button.primary tag="button" x-show="!submitting && !success" type="submit">
            Envoyer mon message
        </x-button.primary>
        <p x-show="!submitting && success" class="flex gap-4 text-lg">
            <span class="w-8">
                @include('elements.icon.check-square')
            </span>
            J'ai bien reçu votre demande, je reviendrai vers vous dans les plus brefs délais.
        </p>
        <p x-show="error" class="flex items-start gap-4">
            <span class="w-8">
                @include('elements.icon.warning')
            </span>
            <span class="text-lg">
                Une erreur est survenue, si le problème persiste merci de me contacter via <a
                    href="mailto:matthieu@updaz.fr" class="underline">matthieu@udpaz.fr</a>
            </span>
        </p>
    </div>
    <p x-show="!submitting && !success" class="text-xs text-gray">
        * Champs requis
    </p>
</form>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit"></script>
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
                turnstile.ready(function() {
                    turnstile.render("#contact-form", {
                        sitekey: "{{ config('custom.recaptcha.public') }}",
                        callback: function(token) {
                            var form = document.getElementById('contact-form');
                            var formData = new FormData(form);
                            formData.append('recaptcha-response', token);
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
                            }).catch(response => {
                                alpineComponent.submitting = false;
                                alpineComponent.success = false;
                                alpineComponent.error = true;
                            });
                        },
                    });
                });
            }
        }))
    });
</script>
