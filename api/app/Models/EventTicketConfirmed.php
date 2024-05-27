<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicketConfirmed extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'check_in',
        'check_out',
    ];
}
