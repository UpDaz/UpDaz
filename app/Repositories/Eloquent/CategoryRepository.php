<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
   /**
    * CategoryRepository constructor.
    *
    * @param Category $model
    */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

   /**
    * @return Collection
    */
    public function all(): Collection
    {
        return $this->model->all();
    }

   /**
    * @return Collection
    */
    public function actives($limit = null): Collection
    {
        return $this->model->where(['is_active' => 1])->limit($limit)->get();
    }

    /**
    * @return Article
    */
    public function getBySlug($slug): ?Category
    {
        return $this->model
                ->where('slug', $slug)
                ->where('is_active', true)
                ->with('articles')
                ->first();
    }
}
