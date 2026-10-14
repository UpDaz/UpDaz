<nav aria-label="Fil d'Ariane" class="flex items-center justify-center gap-2">
    <a href="{{ route('home') }}" aria-label="Accueil" class="-m-2.5 p-2.5">
        @include('elements.icon.home')
    </a>
    @foreach ($links as $label => $link)
        <span aria-hidden="true">@include('elements.icon.arrow-right')</span>
        <a href="{{ $link }}" class="-my-2.5 py-2.5 text-sm">{!! $label !!}</a>
    @endforeach
</nav>
