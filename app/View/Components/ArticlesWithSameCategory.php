<?php

namespace App\View\Components;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ArticlesWithSameCategory extends Component
{
    private Collection $articles;

    public function __construct(private Article $article)
    {
        $categoryIds = $article->categories()->pluck('categories.id');

        $this->articles = $categoryIds->isEmpty()
            ? new Collection()
            : Article::whereHas('categories', fn (Builder $query) => $query->whereIn('categories.id', $categoryIds))
                ->whereNot('id', $article->id)
                ->readable()
                ->whereNotNull('category_id')
                ->with(['category', 'categories'])
                ->orderBy('published_at', 'desc')
                ->get();
    }

    public function render(): View
    {
        return view('components.articles-with-same-category', [
            'articles' => $this->articles,
            'category' => $this->article->category,
        ]);
    }
}
