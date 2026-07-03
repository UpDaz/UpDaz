<?php

namespace App\Models;

use App\Enums\SourceType;
use Database\Factories\SourceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    /** @use HasFactory<SourceFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'type',
        'active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => SourceType::class,
            'active' => 'boolean',
        ];
    }
}
