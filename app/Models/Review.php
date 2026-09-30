<?php

namespace App\Models;

use App\Enums\ReviewPlatform;
use Database\Factories\ReviewFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /** @use HasFactory<ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'reviewed_at',
        'platform',
        'rating',
        'content',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'reviewed_at' => 'date',
            'platform' => ReviewPlatform::class,
            'rating' => 'integer',
        ];
    }

    /**
     * @param  Builder<Review>  $query
     */
    public function scopeMostRecentFirst(Builder $query): void
    {
        $query->orderByDesc('reviewed_at')->orderByDesc('id');
    }

    public function formattedDate(): string
    {
        return $this->reviewed_at->locale('fr')->isoFormat('MMM YYYY');
    }
}
