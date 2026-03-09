<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Collection;

interface ArticleRepositoryInterface
{
    public function all(): Collection;

    public function published(): Collection;

    public function getByCategorySlugAndSlug(string $categorySlug, string $slug): ?Article;
}
