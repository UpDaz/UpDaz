<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function articles()
    {
        return $this->hasMany(Article::class)
                    ->where('is_published', true)
                    ->where('published_at', '<=', date('Y-m-d'));
    }

    /**
     * @return bool
     */
    protected function getHasArticlesAttribute(): bool
    {
        return $this->articles->isNotEmpty();
    }

}
