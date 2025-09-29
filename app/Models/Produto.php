<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'img', 'preco', 'colecao_id', 'descricao', 'tipoproduto_id', 'img2', 'img3', 'esgotado'];
    use HasFactory;
}
