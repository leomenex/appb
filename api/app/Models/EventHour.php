<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventHour extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'start',
        'end',
        'vacancy_limit',
        'vacancy_current',
    ];
}
