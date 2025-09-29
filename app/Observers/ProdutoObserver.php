<?php

namespace App\Observers;
use App\Models\Produto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ProdutoObserver
{
    public function deleted(Produto $produto): void
    {
         // Verifica se a imagem existe no caminho e se é um arquivo válido
         if ($produto->img && File::exists(public_path($produto->img))) {
            // Remove a imagem do diretório
            File::delete(public_path($produto->img));
        }
        if ($produto->img2 && File::exists(public_path($produto->img2))) {
            // Remove a imagem do diretório
            File::delete(public_path($produto->img2));
        }
        if ($produto->img3 && File::exists(public_path($produto->img3))) {
            // Remove a imagem do diretório
            File::delete(public_path($produto->img3));
        }
    }
}
