<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_desktop',
        'img_mobile',
        'titulo',
        'texto',
        'texto_botao',
        'link',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];
}
