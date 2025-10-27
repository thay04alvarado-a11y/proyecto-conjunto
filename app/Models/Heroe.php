<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Heroe extends Model
{
    use HasFactory;
    
    protected $table = 'heroes';
    protected $primaryKey = 'idHeroe';

    protected $fillable = [
        'pagina',
        'imagen',
        'titulo',
        'subtitulo',
    ];
}

