<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'valor',
        'cor',
        'quantidade_estoque',
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'quantidade_estoque' => 'integer',
    ];
}