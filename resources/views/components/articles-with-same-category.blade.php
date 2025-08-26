<div>
    @if ($articles->count())
        <div class="container mx-auto">
            <hr />
            <div class="pb-16 mt-8">

                <div class="flex flex-col gap-8">
                    <div class="flex items-center gap-8">
                        <span class="*:w-16 *:h-auto">
                            @include('elements.icon.book')
                        </span>
                        <h2 class="mb-2 text-3xl">Ces articles pourraient vous intéresser</h2>
                    </div>
                    <div class="grid gap-8 md:grid-cols-2">
                        @foreach ($articles as $article)
                            @include('elements.article.box')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
