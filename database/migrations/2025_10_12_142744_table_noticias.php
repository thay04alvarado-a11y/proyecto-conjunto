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
        Schema::create('noticias', function (Blueprint $table) {
            $table->id('idNoticia');
            $table->string('titulo', 200);
            $table->string('descripcion_corta', 300)->nullable();
            $table->text('descripcion_larga')->nullable();
            $table->string('autor', 100)->nullable();
            $table->date('fecha')->nullable();
            $table->string('imagen')->nullable();

            // 🔹 Relación con la tabla categorias
            $table->foreignId('id_categoria')
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
        Schema::dropIfExists('noticias');
    }
};
