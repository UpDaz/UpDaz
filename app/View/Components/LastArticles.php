<?php

namespace App\View\Components;

use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\Eloquent\ArticleRepository;
use Illuminate\View\Component;

class LastArticles extends Component
{
    private $articleRepository;
    private $limit;
    public $articles = [];

    /**
     * Create the component instance.
     *
     * @param  \App\Repositories\ArticleRepositoryInterface  $articleRepository
     * @param  int  $limit
     * @return void
     */
    public function __construct(ArticleRepositoryInterface $articleRepository, $limit = 6)
    {
        $this->articleRepository = $articleRepository;
        $this->limit = $limit;
        $this->articles = $this->articleRepository->published($limit)->sortByDesc('published_at');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.last-articles');
    }
}
