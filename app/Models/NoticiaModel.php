<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $table = 'noticias'; // solo si quieres especificarlo explícitamente

    protected $fillable = [
        'titulo',
        'resumen',
        'contenido',
        'imagen',
    ];
}
