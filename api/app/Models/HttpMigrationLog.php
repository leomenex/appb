<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HttpMigrationLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'class',
        'line',
        'url',
        'status',
        'message',
        'trace',
    ];

    public function status(): Attribute
    {
        return Attribute::make(
            set: function (mixed $value) {
                if (is_object($value) && property_exists($value, 'name')) {
                    return strtolower($value->name);
                }
            }
        );
    }
}
