<section id="stack" class="-mt-24 pt-24">
    <div class="container mx-auto flex flex-col gap-8 md:gap-16">
        <div class="flex flex-col-reverse items-center justify-center gap-4 sm:flex-row sm:gap-8">
            <div class="*:w-24 sm:*:w-12 *:h-auto">
                @include('elements.icon.programming')
            </div>
            <h2>Ma stack technique Laravel</h2>
        </div>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
            <div class="flex flex-col gap-2">
                <h3 class="text-yellow text-lg font-medium">Back-end</h3>
                <x-skills.item text="Laravel et PHP dans leurs dernières versions" />
                <x-skills.item text="API REST sécurisées (Sanctum)" />
                <x-skills.item text="Files d’attente et tâches planifiées" />
                <x-skills.item text="MySQL, PostgreSQL, SQLite" />
            </div>
            <div class="flex flex-col gap-2">
                <h3 class="text-yellow text-lg font-medium">Interfaces</h3>
                <x-skills.item text="Filament pour les back-offices" />
                <x-skills.item text="Livewire et Alpine.js" />
                <x-skills.item text="Tailwind CSS" />
                <x-skills.item text="Accessibilité et qualité web (certifié Opquast)" />
            </div>
            <div class="flex flex-col gap-2">
                <h3 class="text-yellow text-lg font-medium">Qualité et mise en ligne</h3>
                <x-skills.item text="Tests automatisés (PHPUnit, Pest)" />
                <x-skills.item text="Standards de code (Pint, PHP_CodeSniffer)" />
                <x-skills.item text="Déploiement automatisé" />
                <x-skills.item text="Hébergement et maintenance" />
            </div>
        </div>
    </div>
</section>
