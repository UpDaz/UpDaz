<div class="relative w-full">
    <{{ $tag }} {{ $attributes }}
        class="btn btn-secondary @if ($small) btn-small @endif {{ $classes }}">
        {{ $slot }}
    </{{ $tag }}>
    <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 top-0"></div>
    <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 bottom-0"></div>
    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 left-0"></div>
    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 right-0"></div>
</div>
