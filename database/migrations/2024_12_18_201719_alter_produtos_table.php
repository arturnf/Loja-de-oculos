<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
           $table->unsignedBigInteger('colecao_id'); // Adiciona a coluna de chave estrangeira
           $table->foreign('colecao_id')            // Define como chave estrangeira
                 ->references('id')                     // Referencia o campo 'id' da tabela relacionada
                 ->on('colecaos')                    // Nome da tabela pai
                 ->onDelete('cascade');   
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
