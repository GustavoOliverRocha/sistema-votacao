<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcao extends Model
{
    use HasFactory;
    protected $table = "opcao";
    protected $fillable = [
        'resposta',
        'votacoes'
    ];
}
