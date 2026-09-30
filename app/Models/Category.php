<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    public const WATCH_SLUG = 'veille';

    public const FIELD_EXPERIENCE_SLUG = 'retour-d-experience';

    /**
     * Status labels, only ever attached as secondary categories: an
     * article's URL is built from its main, thematic category.
     *
     * @var array<int, string>
     */
    public const LABEL_SLUGS = [self::WATCH_SLUG, self::FIELD_EXPERIENCE_SLUG];

    protected $fillable = [
        'name',
        'is_active',
        'slug',
        'catch_phrase',
        'meta_title',
        'meta_description',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class)
            ->where('is_published', true)
            ->where('published_at', '<=', date('Y-m-d H:i:s'));
    }

    protected function getHasArticlesAttribute(): bool
    {
        return $this->articles->isNotEmpty();
    }
}
