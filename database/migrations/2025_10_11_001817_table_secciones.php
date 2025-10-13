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
        Schema::create('secciones', function (Blueprint $table) {
            $table->id('idSecciones');
            $table->string('identificador', 100); //ej: 'periodo_matricula', 'semana_u'
            $table->string('titulo', 150)->nullable();
            $table->text('parrafo')->nullable();
            $table->string('imagen')->nullable();
            $table->timestamps();
            $table->boolean('activo')->default(1);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secciones');
    }
};
