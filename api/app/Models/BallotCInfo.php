<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BallotCInfo extends Model
{
    use HasFactory;

    protected $table = 'ballot_c_infos';

    protected $fillable = [
        'cpf',
        'text',
        'reference_year'
    ];
}
