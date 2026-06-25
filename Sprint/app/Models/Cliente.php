<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'idade',
        'quantidade_compras',
        'desconto',
    ];

    protected $casts = [
        'idade' => 'integer',
        'quantidade_compras' => 'integer',
        'desconto' => 'decimal:2',
    ];
}
