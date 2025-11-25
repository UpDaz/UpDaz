<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function index()
    {
        $articles = $this->articleRepository->published();
        return view('articles.index', [
            'articles' => $articles,
        ]);
    }

    public function show($slugCategory, $slug)
    {
        $article = $this->articleRepository->getByCategorySlugAndSlug($slugCategory, $slug);

        if ($article && $article->can_be_read) {
            return view('articles.show', [
                'article' => $article,
            ]);
        } else {
            return redirect()->route('articles');
        }
    }
}
