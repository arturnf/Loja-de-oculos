<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Colecao extends Model
{
    protected $fillable = ['nome', 'img', 'descricao'];
    public function produtos(){
        return $this->hasmany(Produto::class, 'colecao_id');
    }
    use HasFactory;
}
