<footer class="bg-blue py-12">
    <div class="container px-16 py-6 flex flex-wrap justify-center items-center mx-auto relative">
        <div class="text-white text-sm text-center leading-6">
            <a href="{{ route('home') }}">
                <img src="{{ asset('img/logo.svg') }}" class="w-3/4 mb-6 mx-auto" width="225" height="72" alt="UpDaz Logo" title="UpDaz" loading="lazy">
            </a>
            <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank"  class="block mb-6 py-4 md:py-2 pr-4 pl-3 font-bold text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white hover:underline" aria-current="page">
                <img src="{{ asset('img/linkedin.svg') }}" width="30" height="30" alt="Logo Linkedin" title="Linkedin" class="mx-auto" loading="lazy">
            </a>
            © UpDaz {{ date('Y') }}
        </div>
        <p class="absolute -bottom-11 width-full text-center text-sm text-white px-16 ">
            Site créé avec Laravel, TailwindCSS et AlpineJS | Illustrations : <a href="https://themeisle.com/illustrations/" target="_blank" title="Themeisle">Themeisle</a>
        </p>
    </div>
</footer>
