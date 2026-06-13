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

    public $timestamps = false;
}
