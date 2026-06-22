<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $table = 'funcionarios';

    protected $fillable = [
        'nome',
        'data_nascimento',
        'data_admissao',
        'funcao',
        'salario',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'data_admissao'   => 'date',
        'salario'         => 'decimal:2',
    ];
}