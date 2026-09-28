<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function show(string $slug): View|RedirectResponse
    {
        $category = $this->categoryRepository->getBySlug($slug);

        if (! $category) {
            return redirect()->route('articles');
        }

        return view('category.show', [
            'category' => $category,
        ]);
    }
}
