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
        'id_categoria',
    ];

    // Relación con Categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'idCategoria');
    }
}
