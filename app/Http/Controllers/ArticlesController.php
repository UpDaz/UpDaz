<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Redirect;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    public function show(Request $request, string $slugCategory, string $slug): View|RedirectResponse
    {
        $article = $this->articleRepository->getByCategorySlugAndSlug($slugCategory, $slug);

        if (! $article || ! $article->can_be_read) {
            return $this->redirectObsoleteUrl($request->path());
        }

        if ($article->category && $article->category->slug !== $slugCategory) {
            return redirect()->route('article', [
                'categorySlug' => $article->category->slug,
                'slug' => $article->slug,
            ], 301);
        }

        return view('articles.show', [
            'article' => $article,
        ]);
    }

    /**
     * An article URL that no longer serves content: its registered 301 or
     * 410, or the blog index for URLs nobody has decided about.
     */
    private function redirectObsoleteUrl(string $path): RedirectResponse
    {
        $redirect = Redirect::findForPath($path);

        if (! $redirect) {
            return redirect()->route('articles');
        }

        if ($redirect->isGone()) {
            abort(410);
        }

        return redirect($redirect->to_path, 301);
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
