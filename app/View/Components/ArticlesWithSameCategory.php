<?php

namespace App\View\Components;

use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ArticlesWithSameCategory extends Component
{
    private Collection $articles;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(private Article $article)
    {
        $this->articles =
        Article::where('category_id', $article->category_id)
        ->whereNot('id', $article->id)
        ->orderBy('published_at', 'desc')
        ->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.articles-with-same-category', [
            'articles' => $this->articles
        ]);
    }
}
