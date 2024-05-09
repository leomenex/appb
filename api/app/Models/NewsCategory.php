<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'name',
        'description',
        'sort_order',
        'color',
        'text_color',
        'status',
    ];

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }
}
