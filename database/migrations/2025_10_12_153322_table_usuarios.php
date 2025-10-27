<?php

use App\Models\Usuario;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('idUsuario');
            $table->string('nombre', 100);
            $table->string('correo', 150)->unique();
            $table->string('contra', 255);
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });
        
        try {
            DB::beginTransaction();
            $usuario = new Usuario();
            $usuario->nombre = 'Administrador';
            $usuario->correo = 'admin@gmail.com';
            $usuario->contra = Crypt::encryptString('Diosteama.1');
            $usuario->save();
            DB::commit();
        } catch (\Throwable $th) {
            Log::error('Error al crear el usuario: ' . $th->getMessage());
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
