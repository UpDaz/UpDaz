<?php

namespace App\Models;

use App\Casts\Markdown as CastMarkdown;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'content' => CastMarkdown::class,
        'published_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCanBeReadAttribute()
    {
        return $this->is_published && $this->published_at->lte(Carbon::now());
    }
}
