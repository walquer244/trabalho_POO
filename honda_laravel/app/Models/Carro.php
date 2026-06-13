<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    protected $table = 'carros';

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
