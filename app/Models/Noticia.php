<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;
    
    protected $table = 'noticias';
    protected $primaryKey = 'idNoticia';

    protected $fillable = [
        'titulo',
        'descripcion_corta',
        'descripcion_larga',
        'imagen',
        'autor',
        'fecha',
    ];

    // Relación Many-to-Many con Categorías
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categorias_noticias', 'idNoticia', 'idCategoria')
                    ->withTimestamps();
    }
}
