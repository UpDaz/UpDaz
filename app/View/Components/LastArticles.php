<?php

namespace App\View\Components;

use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LastArticles extends Component
{
    public mixed $articles = [];

    public function __construct(
        private ArticleRepositoryInterface $articleRepository,
        ?int $categoryId = null,
        private ?int $limit = 6,
    ) {
        $this->articles = $this->articleRepository->published($categoryId, $limit, 'published_at', 'desc');
    }

    public function render(): View
    {
        return view('components.last-articles');
    }
}
