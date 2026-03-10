<?php

namespace App\View\Components;

use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuCategoryList extends Component
{
    public mixed $categories = [];

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categories = $categoryRepository->actives()->sortBy('name');
    }

    public function render(): View
    {
        return view('components.menu-category-list');
    }
}
