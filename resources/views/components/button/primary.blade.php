<div class="relative w-full flex flex-col items-center justify-center">
    <{{ $tag }} {{ $attributes }}
        class="btn btn-primary @if ($small) btn-small @endif {{ $classes }}">
        {{ $slot }}
    </{{$tag}}>
    <span class="*:text-yellow inline-block">
        @include('elements.icon.lines')
    </span>
</div>
