<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aula extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Clave primaria de la tabla aulas.
     */
    protected $primaryKey = 'id_aula';

    /**
     * Atributos que son asignables.
     */
    protected $fillable = [
        'piso',
        'numero',
        'id_departamento',
    ];
}
