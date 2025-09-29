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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('img');
            $table->decimal('preco', 6, 2);
            $table->string('nome');
            $table->string('descricao');
            $table->timestamps();
            $table->unsignedBigInteger('tipoproduto_id'); // Adiciona a coluna de chave estrangeira
            $table->foreign('tipoproduto_id')            // Define como chave estrangeira
                  ->references('id')                     // Referencia o campo 'id' da tabela relacionada
                  ->on('tipo_produtos')                    // Nome da tabela pai
                  ->onDelete('cascade');                 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
