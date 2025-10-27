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
    Schema::create('heroes', function (Blueprint $table) {
        $table->id('idHeroe'); // equivale a id INT AUTO_INCREMENT PRIMARY KEY
        $table->string('pagina', 100)->nullable(); //about, contact, etc
        $table->string('imagen', 255)->nullable();
        $table->string('titulo', 150)->nullable();
        $table->string('subtitulo', 255)->nullable();
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
