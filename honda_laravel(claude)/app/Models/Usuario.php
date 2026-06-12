<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'nivel_acesso',
    ];

    protected $hidden = ['senha'];

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = null;
}
