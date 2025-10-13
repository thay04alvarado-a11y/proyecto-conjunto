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
         Schema::create('categorias_noticias', function (Blueprint $table) {
            $table->id('idCategoriaNoticia');
            $table->foreignId('idNoticia')
                  ->nullable()
                  ->constrained('noticias', 'idNoticia')
                  ->nullOnDelete();
            $table->foreignId('idCategoria')
                  ->nullable()
                  ->constrained('categorias', 'idCategoria')
                  ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias_noticias');
    }
};
