<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicketReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'customer',
        'qrcode_path',
        'expires_in',
        'canceled_at',
        'confirmed_at',
    ];
}
