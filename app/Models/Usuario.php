<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';

    protected $fillable = [
        'nombre',
        'correo',
        'contra',
        'activo',
    ];

    protected $hidden = [
        'contra',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
}
