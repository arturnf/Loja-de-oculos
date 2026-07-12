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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('img_desktop')->nullable()->comment('Imagem do banner para desktop');
            $table->string('img_mobile')->nullable()->comment('Imagem do banner para mobile');
            $table->string('link')->nullable()->comment('Link para redirecionamento ao clicar');
            $table->boolean('ativo')->default(true)->comment('Banner ativo ou inativo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
