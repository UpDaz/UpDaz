@php
    $settings = config("custom.reviews.{$platform->value}");
    $reviewsCount = \App\Models\Review::query()->where('platform', $platform)->count();
    $hasScore = $settings['rating'] && $reviewsCount;
    $label = $hasScore
        ? number_format($settings['rating'], 1, ',', ' ') . ' · ' . $reviewsCount . ' avis'
        : null;
@endphp
<a href="{{ $settings['url'] }}" target="_blank" rel="nofollow noopener"
    title="{{ $hasScore ? "Note {$label} sur {$name}" : "Avis clients sur {$name}" }}"
    class="flex justify-start gap-2 flex-row items-center">
    <img src="{{ asset($logo) }}" alt="{{ $name }}" class="h-8 w-auto max-w-none self-start" width="{{ $width }}" height="32" />
    <span class="text-yellow flex" aria-hidden="true">
        @for ($i = 1; $i <= 5; $i++)
            @include('elements.icon.star')
        @endfor
    </span>
    @if ($hasScore)
        <span class="whitespace-nowrap text-sm">{{ $label }}</span>
    @endif
</a>
