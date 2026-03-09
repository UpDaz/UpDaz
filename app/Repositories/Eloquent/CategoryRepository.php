<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function actives(?int $limit = null): Collection
    {
        return $this->model->where(['is_active' => 1])->limit($limit)->get();
    }

    public function getBySlug(string $slug): ?Category
    {
        return $this->model
            ->where('slug', $slug)
            ->where('is_active', true)
            ->with('articles')
            ->first();
    }
}
