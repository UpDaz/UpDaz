<div x-data="cookieBanner" x-show="visible" x-cloak x-transition.opacity role="region" aria-label="Information sur les cookies" class="bg-blue-dark p-4 md:py-2 text-sm text-white w-full md:w-auto items-center md:items-start fixed bottom-0 md:right-4 z-50 shadow-white">

    <div class="flex flex-row justify-around gap-4  items-center">
        <p class="grow flex flex-col items-start">
            Ce site utilise des cookies.
            <a href="{{ route('legal-notices') }}#cookies" class="hover:text-yellow underline">En savoir plus</a>
        </p>
        <div>
            <x-button.primary title="Accepter les cookies" @click="dismiss()" :small="true" classes="text-nowrap">
                j'ai compris
                </x-button-primary>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('cookieBanner', () => ({
            storageKey: 'updaz-cookie-banner-dismissed',
            visible: false,
            init() {
                try {
                    this.visible = localStorage.getItem(this.storageKey) === null;
                } catch (e) {
                    this.visible = true;
                }
            },
            dismiss() {
                this.visible = false;

                try {
                    localStorage.setItem(this.storageKey, new Date().toISOString());
                } catch (e) {}
            },
        }));
    });
</script>
