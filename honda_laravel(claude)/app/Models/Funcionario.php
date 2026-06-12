<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';

    protected $fillable = [
        'nome',
        'funcao',
        'data_admissao',
        'data_nascimento',
        'salario',
    ];

    const CREATED_AT = 'data_cadastro';
    const UPDATED_AT = null;
}
