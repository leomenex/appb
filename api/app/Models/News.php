<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'content',
        'slug',
        'show_in_slide',
        'path_image',
        'path_image_thumbnail',
        'is_published',
        'date_published',
        'start_time',
        'end_time',
        'external_id',
        'external_created_at',
        'external_updated_at',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class);
    }
}
