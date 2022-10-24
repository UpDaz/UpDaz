<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;    
    }

    public function show($slugCategory, $slug)
    {
        $article = $this->articleRepository->getByCategorySlugAndSlug($slugCategory, $slug);
        
        if ($article) {
            return view('article.show', [
                'article' => $article,
            ]);
        } else {
            return redirect()->route('home');
        }
    }
}
