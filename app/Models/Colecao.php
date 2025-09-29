<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colecao extends Model
{
    protected $fillable = ['nome', 'img', 'descricao'];
    use HasFactory;
}
