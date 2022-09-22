<div class="flex items-center justify-center gap-2">
    <div>
        <a href="{{ route('home') }}">
            @include('elements.svg-icons.home')
        </a>
    </div>
    @foreach($links as $label => $link)
        <div>
            @include('elements.svg-icons.arrow-right')
        </div>
        <a href="{{ $link }}">{!! $label !!}</a>
    @endforeach
</div>
