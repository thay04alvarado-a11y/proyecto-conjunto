<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelUsuarios extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'usuarios';

    // Nombre de la clave primaria
    protected $primaryKey = 'idUsuario';

    // Desactiva timestamps si tu tabla no tiene created_at y updated_at
    public $timestamps = false;

    /**
     * Campos que se pueden asignar masivamente
     * (usados en create() o update()).
     */
    protected $fillable = [
        'nombre',
        'correo',
        'contra',
        'activo',
    ];

    /**
     * Campos que se deben ocultar al devolver el modelo como JSON (opcional).
     */
    protected $hidden = [
        'contra',
    ];

    /**
     * Casts de tipo de datos para columnas específicas.
     */
    protected $casts = [
        'activo' => 'boolean',
    ];
}
