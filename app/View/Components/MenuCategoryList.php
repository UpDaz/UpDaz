<?php

namespace App\View\Components;

use App\Repositories\CategoryRepositoryInterface;
use Illuminate\View\Component;

class MenuCategoryList extends Component
{
    public $categories = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categories = $categoryRepository->actives()->sortBy('name');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu-category-list');
    }
}
