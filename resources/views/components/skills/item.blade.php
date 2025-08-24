<div class="flex items-center gap-2">
    {{-- @isset ($icon)
        <span class="w-6">
            @include($icon)
        </span>
    @endisset --}}
    <span>·</span>
    @isset($text)
        {{ $text }}
    @endisset
</div>
