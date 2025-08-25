<div class="relative w-full">
    <{{ $tag }} {{ $attributes }}
        class="inline-block w-full @if ($small) px-3 py-2 text-md @else px-6 py-3 @endif text-center text-white border border-blue bg-transparent hover:bg-blue {{ $classes }}">
        {{ $slot }}
    </{{ $tag }}>
    <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 top-0"></div>
    <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[125%] -translate-x-1/2 bottom-0"></div>
    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 left-0"></div>
    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[125%] -translate-y-1/2 right-0"></div>
</div>
