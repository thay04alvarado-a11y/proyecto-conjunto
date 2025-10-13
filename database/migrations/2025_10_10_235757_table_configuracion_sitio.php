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
        $table->text('footer_sitio')->nullable();
        $table->timestamp('creado_en')->useCurrent();
        $table->timestamp('actualizado_en')->useCurrent()->useCurrentOnUpdate();
        $table->boolean('activo')->default(1);
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
