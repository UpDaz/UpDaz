<div class="flex items-start items-center justify-center gap-2">
    <a href="{{ route('home') }}">
        @include('elements.icon.home')
    </a>
    @foreach ($links as $label => $link)
        <span>@include('elements.icon.arrow-right')</span>
        <a href="{{ $link }}" class="text-sm">{!! $label !!}</a>
    @endforeach
</div>
