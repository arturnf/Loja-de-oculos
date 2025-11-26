<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class TipoProduto extends Model
{
    use HasFactory;
    use HasEagerLimit;
    public function produtos() {
        return $this->hasMany(Produto::class, 'tipoproduto_id');
    } 
    protected $fillable = [
        'nome'
    ];
}
