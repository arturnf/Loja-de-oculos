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
        Schema::table('banners', function (Blueprint $table) {
            $table->string('titulo')->nullable()->after('img_mobile')->comment('Texto principal do banner');
            $table->text('texto')->nullable()->after('titulo')->comment('Texto complementar do banner');
            $table->string('texto_botao')->nullable()->after('texto')->comment('Texto do botão do banner');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn(['titulo', 'texto', 'texto_botao']);
        });
    }
};
