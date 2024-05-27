<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_hour_id',
        'code',
        'additional_information',
    ];

    public function hour(): BelongsTo
    {
        return $this->belongsTo(EventHour::class);
    }
}
