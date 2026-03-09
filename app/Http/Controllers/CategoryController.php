<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public function __construct(private CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function show(string $slug): View
    {
        $category = $this->categoryRepository->getBySlug($slug);

        return view('category.show', [
            'category' => $category,
        ]);
    }
}
