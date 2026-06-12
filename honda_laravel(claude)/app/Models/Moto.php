<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    protected $table = 'motos';

    protected $fillable = [
        'marca',
        'modelo',
        'cor',
        'ano',
        'valor',
    ];

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = null;
}
