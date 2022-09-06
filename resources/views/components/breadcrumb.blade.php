<div class="flex items-center justify-center gap-2">
    <div>
        @include('elements.icons.home')
    </div>
    @foreach($links as $label => $link)
        <div>
            @include('elements.icons.arrow-right')
        </div>
        <a href="{{ $link }}">{!! $label !!}</a>
    @endforeach
</div>
