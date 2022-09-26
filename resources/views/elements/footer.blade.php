<footer class="bg-blue py-12">
    <div class="container px-16 py-6 flex flex-wrap justify-center items-center mx-auto relative">
        <div class="text-white text-sm text-center leading-6">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo.svg') }}" class="w-3/4 mb-6 mx-auto h-auto" width="225" height="72" alt="UpDaz Logo" title="UpDaz" loading="lazy">
            </a>
            <div class="flex items-center justify-center mb-6 gap-10 my-4">
                <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank"  class="font-bold text-white" aria-current="page">
                    <img src="{{ asset('img/logos/linkedin.svg') }}" width="30" height="30" alt="Logo Linkedin" title="Linkedin" class="mx-auto" loading="lazy">
                </a>
                <a href="https://www.malt.fr/profile/matthieudazord" target="_blank" title="Malt" class="font-bold text-white" aria-current="page">
                    <img src="{{ asset('img/logos/malt.svg') }}" width="30" height="30" alt="Logo Malt" title="Malt" class="mx-auto">
                </a>
                <a href="https://plateforme.freelance.com/freelance/Matthieu-c34713cf-17ba-4a64-8b99-aa21e240582b" target="_blank" title="Freelance.com" class="font-bold text-white" aria-current="page">
                    <img src="{{ asset('img/logos/freelance.svg') }}" width="36" height="30" alt="Logo Frellance.com" title="Freelance.com" class="mx-auto">
                </a>
                <a href="https://github.com/UpDaz" target="_blank" title="Github" class="font-bold text-white" aria-current="page">
                    <img src="{{ asset('img/logos/github.svg') }}" width="30" height="30" alt="Logo Github" title="Github" class="mx-auto">
                </a>
            </div>
            © UpDaz {{ date('Y') }}
        </div>
        <p class="absolute -bottom-11 width-full text-center text-sm text-white px-16 ">
            Site créé avec Laravel, TailwindCSS et AlpineJS | Illustrations : <a href="https://themeisle.com/illustrations/" target="_blank" title="Themeisle">Themeisle</a>
        </p>
    </div>
</footer>
