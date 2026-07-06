<?php

namespace App\Models;

use App\Casts\Markdown as CastMarkdown;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCanBeReadAttribute()
    {
        return $this->is_published && $this->published_at->lte(Carbon::now());
    }

    public function getMetaTitleAttribute()
    {
        return substr($this->title, 0, 52);
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
