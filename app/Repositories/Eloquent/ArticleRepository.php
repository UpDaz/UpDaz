<?php

namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\ArticleRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
   /**
    * ArticleRepository constructor.
    *
    * @param Article $model
    */
    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

   /**
    * @return Collection
    */
    public function all(): Collection
    {
        return $this->model
                ->all();
    }

   /**
    * @return Collection
    */
    public function published(
        ?int $categoryId = null,
        ?int $limit = null,
        $orderField = 'title',
        $orderDirection = 'asc'
    ): Collection {
        return $this->model
                ->where('is_published', true)
                ->where('published_at', '<=', date('Y-m-d 23:59:59'))
                ->whereHas('category', function (Builder $q) {
                    $q->where('is_active', true);
                })
                ->when($categoryId, function (Builder $query) use ($categoryId) {
                    $query->where('category_id', $categoryId);
                })
                ->with('category')
                ->orderBy($orderField, $orderDirection)
                ->limit($limit)
                ->get();
    }

    /**
     *
     * @param string $categorySlug
     * @param string $slug
     * @return Article
     */
    public function getByCategorySlugAndSlug($categorySlug, $slug): ?Article
    {
        return $this->model
        ->where('slug', $slug)
        ->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug)
                ->where('is_active', true);
        })
        ->with('category')
        ->first();
    }
}
