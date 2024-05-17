<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BallotCServer extends Model
{
    use HasFactory;

    protected $table = 'ballot_c_servers';

    protected $fillable = [
        'cpf',
        'name',
        'mother',
        'idrec',
        'reference_year',
    ];
}
