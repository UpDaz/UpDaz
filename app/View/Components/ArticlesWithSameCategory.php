<?php

namespace App\View\Components;

use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ArticlesWithSameCategory extends Component
{
    private Collection $articles;

    public function __construct(private Article $article)
    {
        $this->articles =
        Article::where('category_id', $article->category_id)
            ->whereNot('id', $article->id)
            ->orderBy('published_at', 'desc')
            ->get();
    }

    public function render(): View
    {
        return view('components.articles-with-same-category', [
            'articles' => $this->articles,
        ]);
    }
}
