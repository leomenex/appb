<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'date',
        'is_draft',
    ];

    public function hours(): HasMany
    {
        return $this->hasMany(EventHour::class);
    }

    public function location(): HasOne
    {
        return $this->hasOne(EventLocation::class);
    }
}
