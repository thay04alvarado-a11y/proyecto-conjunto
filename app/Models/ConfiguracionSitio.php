<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionSitio extends Model
{
    use HasFactory;
    
    protected $table = 'configuracion_sitio';
    protected $primaryKey = 'idConfiguracion';

    protected $fillable = [
        'nombre_sitio',
        'logo_sitio',
        'activo',
    ];
}

