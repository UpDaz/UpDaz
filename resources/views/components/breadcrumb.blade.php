<div class="flex items-start justify-center gap-2">
    <div>
        <a href="{{ route('home') }}">
            <x-heroicon-o-home/>
        </a>
    </div>
    @foreach($links as $label => $link)
        <div>
            <x-heroicon-o-arrow-right/>
        </div>
        <a href="{{ $link }}">{!! $label !!}</a>
    @endforeach
</div>
