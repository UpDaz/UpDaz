<?php

namespace App\Http\Controllers;

use App\Models\Article;
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

    /**
     * Preview a draft article regardless of its publication status.
     * Only reachable via a signed URL (see the `signed` middleware on
     * the `articles.preview` route), so it grants dedicated access to
     * reviewers without making the draft publicly reachable.
     */
    public function preview(Article $article): View
    {
        return view('articles.show', [
            'article' => $article,
        ]);
    }
}
