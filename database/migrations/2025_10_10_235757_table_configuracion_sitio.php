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
    Schema::create('configuracion_sitio', function (Blueprint $table) {
        $table->id('idConfiguracion');
        $table->string('nombre_sitio', 150);
        $table->string('logo_sitio', 255)->nullable();
        $table->boolean('activo')->default(1);
        $table->timestamps();
});

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion_sitio');
    }
};
