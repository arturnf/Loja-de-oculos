<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipoProduto;
use App\Models\Colecao;

class Produto extends Model
{
    

    public function tipo()
    {
        return $this->belongsTo(TipoProduto::class, 'tipoproduto_id'); 
        // 'tipo_id' é a coluna FK em produtos
    }

    public function colecao()
    {
        return $this->belongsTo(Colecao::class, 'colecao_id');
    }

    protected $fillable = ['nome', 'img', 'preco', 'preco_antigo', 'colecao_id', 'descricao', 'tipoproduto_id', 'img2', 'img3', 'esgotado'];
    use HasFactory;
}
