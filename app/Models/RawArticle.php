<?php

namespace App\Models;

use Database\Factories\RawArticleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RawArticle extends Model
{
    /** @use HasFactory<RawArticleFactory> */
    use HasFactory;

    protected $fillable = [
        'source_id',
        'title',
        'url',
        'content',
        'published_at',
        'theme',
        'summary',
        'keywords',
        'analyzed_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'keywords' => 'array',
            'analyzed_at' => 'datetime',
        ];
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class);
    }
}
