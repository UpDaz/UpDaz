<?php

namespace App\Models;

use Database\Factories\WeeklyDigestFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WeeklyDigest extends Model
{
    /** @use HasFactory<WeeklyDigestFactory> */
    use HasFactory;

    protected $fillable = [
        'week_start',
        'theme',
        'summary',
        'raw_article_ids',
        'post_id',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'week_start' => 'date',
            'raw_article_ids' => 'array',
        ];
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'post_id');
    }
}
