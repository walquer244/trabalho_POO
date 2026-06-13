<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    protected $table = 'motos';

    protected $fillable = [
        'marca',
        'modelo',
        'ano',
        'quilometragem',
        'cor',
        'valor',
    ];

    public $timestamps = false;
}
