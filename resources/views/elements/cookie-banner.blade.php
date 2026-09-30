{{-- Shown client-side only, so pages served from the response cache stay identical for every visitor. --}}
<div x-data="cookieBanner" x-show="visible" x-cloak x-transition.opacity role="region" aria-label="Information sur les cookies" class="bg-blue-dark border-gray border-t fixed bottom-0 z-50 w-full">
    <div class="container mx-auto p-4 text-sm text-white ">
        <div class="flex flex-col justify-around gap-4 sm:flex-row sm:items-center">
            <p class="grow">
                Ce site utilise des cookies pour mesurer son audience.
                <a href="{{ route('legal-notices') }}#cookies" class="hover:text-yellow underline">En savoir plus</a>
            </p>
            <div>
                <x-button.primary title="Accepter les cookies" @click="dismiss()" :small="true">
                    j'ai compris
                    </x-button-primary>
            </div>
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
