<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BallotCConfig extends Model
{
    use HasFactory;

    protected $table = 'ballot_c_configs';

    protected $fillable = [
        'name',
        'font',
        'doc',
        'email',
        'reference_year'
    ];
}
