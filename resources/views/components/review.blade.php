@props([
    'name',
    'source',
    'date',
    'rating' => 5,
])

@php
    $initials = collect(explode(' ', $name))
        ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
        ->take(2)
        ->implode('');

    $logoPath = match (strtolower($source)) {
        'google' => 'img/logos/google.svg',
        'malt'   => 'img/logos/malt.svg',
        'cosme'  => 'img/logos/cosme.svg',
        default  => null,
    };
@endphp

<div class="relative flex flex-col gap-5 p-6">
    <div class="flex items-start justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="flex items-center justify-center size-10 shrink-0 bg-blue text-white text-sm font-semibold">
                {{ $initials }}
            </div>
            <div class="flex flex-col gap-1">
                <span class="font-semibold leading-none">{{ $name }}</span>
                <div class="flex items-center gap-2 text-xs text-gray">
                    <span class="flex">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="{{ $i <= $rating ? 'text-yellow' : 'text-gray/30' }} *:size-3">
                                @include('elements.icon.star')
                            </span>
                        @endfor
                    </span>
                    <span>·</span>
                    <span>{{ $date }}</span>
                </div>
            </div>
        </div>
        @if ($logoPath)
            <img src="{{ asset($logoPath) }}" alt="{{ $source }}" class="h-4 w-auto shrink-0" loading="lazy" />
        @else
            <span class="text-xs uppercase tracking-widest text-gray">{{ $source }}</span>
        @endif
    </div>
    <p class="text-white before:content-['«\00a0'] after:content-['\00a0»'] italic">{{ $slot }}</p>

    <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[110%] -translate-x-1/2 top-0 bg-gradient-to-r from-transparent via-gray to-transparent"></div>
    <div data-element="line-horizontal" class="absolute h-[1px] left-1/2 w-[110%] -translate-x-1/2 bottom-0 bg-gradient-to-r from-transparent via-gray to-transparent"></div>
    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[110%] -translate-y-1/2 left-0 bg-gradient-to-b from-transparent via-gray to-transparent"></div>
    <div data-element="line-vertical" class="absolute w-[1px] top-1/2 h-[110%] -translate-y-1/2 right-0 bg-gradient-to-b from-transparent via-gray to-transparent"></div>
</div>
