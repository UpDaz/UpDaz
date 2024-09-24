<div>
    <h2 class="mb-2 text-3xl">Ces articles pourraient vous intéresser</h2>
    <div class="w-20 h-1 rounded bg-blue"></div>
    <div class="flex flex-wrap -mx-4">
        @foreach($articles as $article)
            @include('elements.article.box')
        @endforeach
    </div>    
</div>
