<?php

namespace App\Models;

use App\Casts\Markdown as CastMarkdown;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    /**
     * How long a signed preview link stays valid (see `frontendUrl()`).
     */
    public const PREVIEW_LINK_VALIDITY_DAYS = 30;

    protected $fillable = [
        'title',
        'content',
        'is_published',
        'catch_phrase',
        'slug',
        'category_id',
        'published_at',
        'meta_description',
        'tags',
        'generated_by_agent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'content' => CastMarkdown::class,
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'tags' => 'array',
        'generated_by_agent' => 'boolean',
    ];

    /**
     * The main category: it builds the article's canonical URL.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Every category the article is listed in, main category included.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /** @return Collection<int, Category> */
    public function categoriesWithMainFirst(): Collection
    {
        return $this->categories
            ->sortBy(fn (Category $category): int => $category->id === $this->category_id ? 0 : 1)
            ->values();
    }

    /**
     * Same rule as `can_be_read`, as a query: published and already due.
     */
    public function scopeReadable(Builder $query): void
    {
        $query->where('is_published', true)
            ->where('published_at', '<=', Carbon::now());
    }

    public function getCanBeReadAttribute()
    {
        return $this->is_published && $this->published_at->lte(Carbon::now());
    }

    public function getMetaTitleAttribute(): string
    {
        return Str::limit($this->title, 52, '…', preserveWords: true);
    }

    public function getMetaDescriptionAttribute()
    {
        return $this->attributes['meta_description'] ?? substr((string) $this->catch_phrase, 0, 150);
    }

    /**
     * Where this article can be read on the front-office: its normal
     * public URL once published and categorized, or a signed preview
     * link otherwise (dedicated, non-public access — see
     * `ArticlesController::preview()`).
     */
    public function frontendUrl(): string
    {
        if ($this->can_be_read && $this->category_id !== null) {
            return route('article', [
                'categorySlug' => $this->category->slug,
                'slug' => $this->slug,
            ]);
        }

        return URL::temporarySignedRoute(
            'articles.preview',
            now()->addDays(self::PREVIEW_LINK_VALIDITY_DAYS),
            ['article' => $this->id],
        );
    }
}
