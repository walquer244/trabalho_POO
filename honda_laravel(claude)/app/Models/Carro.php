<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    protected $table = 'carros';

    protected $fillable = [
        'marca',
        'modelo',
        'cor',
        'ano',
        'valor',
    ];

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = null; // tabela não tem updated_at
}
