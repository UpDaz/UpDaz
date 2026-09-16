<div class="relative ">
    <{{ $tag }} {{ $attributes }} class="btn btn-secondary @if ($small) btn-small @endif {{ $classes }}">
        <span>{{ $slot }}</span>
        <span class="lg:self-end inline-block">
            @include('elements.icon.line')
        </span>
        </{{ $tag }}>
</div>
