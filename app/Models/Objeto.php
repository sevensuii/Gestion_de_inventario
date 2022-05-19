<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objeto extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Clave primaria de la tabla objetos.
     */
    protected $primaryKey = 'id';

    /**
     * Atributos que son asignables.
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'id_aula',
    ];
}
