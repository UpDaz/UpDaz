<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryController;

    public function __construct(CategoryRepositoryInterface $categoryController)
    {
        $this->categoryController = $categoryController;
    }

    public function show($slug)
    {
        $category = $this->categoryController->getBySlug($slug);

        return view('category.show', [
            'category' => $category,
        ]);
    }
}
