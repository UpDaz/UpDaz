<footer class="border-t border-gray">
    <div class="container flex flex-col items-center px-5 py-8 mx-auto sm:flex-row">
        <a href="{{ route('home') }}" class="w-1/2 md:w-1/12">
            <img src="{{ asset('img/logo.svg') }}" class="w-auto h-auto" width="225" height="72" alt="UpDaz Logo"
                title="UpDaz" loading="lazy">
        </a>
        <p class="mt-4 text-sm text-white sm:ml-4 sm:pl-4 sm:border-l sm:border-gray-200 sm:py-2 sm:mt-0">
            © {{ date('Y') }} UpDaz -
            <a href="{{ route('legal-notices') }}" class="w-full md:w-1/12">
                Mentions légales
            </a>
        </p>
        <span class="inline-flex justify-center mt-4 sm:ml-auto sm:mt-0 sm:justify-start">
            <a href="https://fr.linkedin.com/in/matthieu-dazord" target="_blank" title="Linkedin"
                class="mr-6 text-white" aria-current="page">
                <img src="{{ asset('img/logos/white/linkedin.svg') }}" width="30" height="30" alt="Logo Linkedin"
                    title="Linkedin" class="mx-auto" loading="lazy">
            </a>
            <a href="https://github.com/UpDaz" target="_blank" title="Github" class="text-white underline"
                aria-current="page">
                <img src="{{ asset('img/logos/white/github.svg') }}" width="30" height="30" alt="Logo Github"
                    title="Github" class="mx-auto">
            </a>
        </span>
    </div>
</footer>
