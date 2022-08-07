<form x-data="contactForm" id="contact-form" @submit.prevent="submitForm()" class="bg-orange shadow-md rounded px-4 md:px-10 py-8 mb-4">
    <div class="mb-4">
        <input placeholder="Prénom*" name="firstname" class=" placeholder-gray-800 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="firstname" type="text" required>
    </div>
    <div class="mb-4">
        <input placeholder="Nom*" name="lastname" class="placeholder-gray-800 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" type="text" required>
    </div>
    <div class="mb-4">
        <input placeholder="Email*" name="email" class="placeholder-gray-800 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" required>
    </div>
    <div class="mb-4">
        <input placeholder="Téléphone*" name="phone" class="placeholder-gray-800 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" type="text" required>
    </div>
    <div class="mb-4">
        <textarea placeholder="Message*" name="message" id="message" cols="30" rows="10" class="placeholder-gray-800 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
    </div>
    <div class="flex items-center justify-between">
        <p x-show="!submitting && !success" class="text-white text-xs">
            * Champs requis
        </p>
        <div>
            <img src="{{ asset('img/loader.svg') }}" alt="Loader" title="Chargement" x-show="submitting"/>
            <button x-show="!submitting && !success" class="bg-blue hover:bg-blue-dark text-white shadow-md px-6 py-3 rounded">
                Envoyer
            </button>
            <p x-show="!submitting && success" class="text-white bold block md:flex items-center text-right md:text-left">
                <img src="{{ asset('img/illustrations/check-rounded-orange.svg')}}" class="mx-auto md:mr-2" width="30" alt="Picto check" title="Check"/>
                Message envoyé avec succés !
            </p>
            <p x-show="error" class="text-red-500 bold mt-2 block md:flex items-center text-right md:text-left">
                <img src="{{ asset('img/illustrations/warning.svg')}}" class="mx-auto md:mr-3" width="30" alt="Picto warning" title="Erreur"/>
                Une erreur est survenue,<br/>si le problème persiste merci de me contacter via matthieu@udpaz.fr
            </p>
        </div>
    </div>
</form>

<script src="https://www.google.com/recaptcha/api.js?render={{ config('custom.recaptcha.public') }}" async defer></script>

<script type="text/javascript">
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
