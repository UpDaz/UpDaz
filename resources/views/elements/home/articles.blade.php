<section id="articles" class="px-8 py-16 md:px-16">
    <div class="container mx-auto">
        <h2 class="mb-6 text-3xl text-black font-title bold">Mes derniers articles</h2>
        <div class="w-20 h-1 rounded bg-blue"></div>
        <x-last-articles />
        <div class="mt-8 text-center">
            <a href="{{ route('articles') }}" class="inline-block px-6 py-3 font-medium text-center text-white rounded shadow-md bg-gradient-to-br hover:bg-gradient-to-r from-blue-dark to-blue hover:bg-orange">
                Voir tous les articles
            </a>
        </div>
    </div>
</section>
