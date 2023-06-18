<form x-data="contactForm" id="contact-form" @submit.prevent="submitForm()">
    <div class="mb-4">
        <input placeholder="Prénom*" name="firstname" class="w-full px-3 py-2 leading-tight placeholder-gray-800 border rounded appearance-none focus:outline-none focus:shadow" id="firstname" type="text" required>
    </div>
    <div class="mb-4">
        <input placeholder="Nom*" name="lastname" class="w-full px-3 py-2 leading-tight placeholder-gray-800 border rounded appearance-none focus:outline-none focus:shadow" id="lastname" type="text" required>
    </div>
    <div class="mb-4">
        <input placeholder="Email*" name="email" class="w-full px-3 py-2 leading-tight placeholder-gray-800 border rounded appearance-none focus:outline-none focus:shadow" id="email" type="email" required>
    </div>
    <div class="mb-4">
        <input placeholder="Téléphone*" name="phone" class="w-full px-3 py-2 leading-tight placeholder-gray-800 border rounded appearance-none focus:outline-none focus:shadow" id="phone" type="text" required>
    </div>
    <div class="mb-4">
        <textarea placeholder="Message*" name="message" id="message" cols="30" rows="10" class="w-full px-3 py-2 leading-tight placeholder-gray-800 border rounded appearance-none focus:outline-none focus:shadow"></textarea>
    </div>
    <div class="flex items-center justify-between">
        <p x-show="!submitting && !success" class="text-xs text-black">
            * Champs requis
        </p>
        <div>
            <img src="{{ asset('img/loader.svg') }}" alt="Loader" title="Chargement" x-show="submitting"/>
            <button x-show="!submitting && !success" class="block px-6 py-3 font-medium text-white rounded shadow-md bg-orange">
                Envoyer
            </button>
            <p x-show="!submitting && success" class="items-center block text-right text-white bold md:flex md:text-left">
                <img src="{{ asset('img/illustrations/check-rounded-orange.svg')}}" class="mx-auto md:mr-2" width="30" alt="Picto check" title="Check"/>
                Votre demande a bien été envoyé, vous allez recevoir un email de confirmation dans les plus brefs délais.
            </p>
            <p x-show="error" class="items-center block mt-2 text-right text-red-500 bold md:flex md:text-left">
                <img src="{{ asset('img/illustrations/warning.svg')}}" class="mx-auto md:mr-3" width="30" alt="Picto warning" title="Erreur"/>
                Une erreur est survenue,<br/>si le problème persiste merci de me contacter via matthieu@udpaz.fr
            </p>
        </div>
    </div>
</form>

<script src="https://www.google.com/recaptcha/api.js?render={{ config('custom.recaptcha.public') }}" defer></script>

<script type="text/javascript" defer>
    document.addEventListener('alpine:init', () => {
        Alpine.data('contactForm', () => ({
            submitting : false,
            success : false,
            error: false,
            submitForm() {
                this.submitting = true;
                this.success = false;
                this.error = false;
                let alpineComponent = this;
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ config('custom.recaptcha.public') }}', {action: 'submit'})
                    .then(function(token) {
                        var form = document.getElementById('contact-form');
                        var formData = new FormData(form);
                        formData.append('g-recaptcha-response', token);
                        axios({
                            method: "post",
                            url: "{{ route('contact') }}",
                            data: formData,
                            headers: { "Content-Type": "multipart/form-data" },
                        }).then(response => {
                            alpineComponent.submitting = false;
                            alpineComponent.success = true;
                        }).catch(response => {
                            alpineComponent.submitting = false;
                            alpineComponent.success = false;
                            alpineComponent.error = true;
                        });
                    });
                });
            }
        }))
    })
</script>
