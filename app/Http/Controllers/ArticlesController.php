<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticlesController extends Controller
{
    public function __construct(private ArticleRepositoryInterface $articleRepository)
    {
    }

    public function index(): View
    {
        $articles = $this->articleRepository->published();

        return view('articles.index', [
            'articles' => $articles,
        ]);
    }

    public function show(string $slugCategory, string $slug): View|RedirectResponse
    {
        $article = $this->articleRepository->getByCategorySlugAndSlug($slugCategory, $slug);

        if (! $article || ! $article->can_be_read) {
            return redirect()->route('articles');
        }

        return view('articles.show', [
            'article' => $article,
        ]);
    }
}
