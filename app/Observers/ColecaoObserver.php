<?php

namespace App\Observers;

use Illuminate\Support\Facades\Storage;
use App\Models\Colecao;
use Illuminate\Support\Facades\File;

class ColecaoObserver
{
    /**
     * Handle the Colecao "created" event.
     */
    public function created(Colecao $colecao): void
    {
        //
    }

    /**
     * Handle the Colecao "updated" event.
     */
    public function updated(Colecao $colecao): void
    {
        //
    }

    /**
     * Handle the Colecao "deleted" event.
     */
    public function deleted(Colecao $colecao): void
    {
        // Verifica se a imagem existe no caminho e se é um arquivo válido
        if ($colecao->img && File::exists(public_path($colecao->img))) {
            // Remove a imagem do diretório
            File::delete(public_path($colecao->img));
        }
    }

    /**
     * Handle the Colecao "restored" event.
     */
    public function restored(Colecao $colecao): void
    {
        //
    }

    /**
     * Handle the Colecao "force deleted" event.
     */
    public function forceDeleted(Colecao $colecao): void
    {
        //
    }
}
