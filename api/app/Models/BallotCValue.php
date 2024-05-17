<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BallotCValue extends Model
{
    use HasFactory;

    protected $table = 'ballot_c_values';

    protected $fillable = [
        'cpf',
        'name',
        'value',
        'month',
        'reference_year',
    ];
}
