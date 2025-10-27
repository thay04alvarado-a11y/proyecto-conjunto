<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;
    
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
