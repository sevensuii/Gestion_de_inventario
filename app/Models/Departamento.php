<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Clave primaria de la tabla departamentos.
     */
    protected $primaryKey = 'id_departamento';

    /**
     * Atributos que son asignables.
     */
    protected $fillable = [
        'nombre',
        'jefe_departamento',
    ];
}
