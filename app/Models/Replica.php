<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Replica extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Clave primaria de la tabla replicas.
     */
    protected $primaryKey = 'id_replica';

    /**
     * Atributos que son asignables.
     */
    protected $fillable = [
        'codigo_qr',
        'objeto',
        'incidencias',
    ];
}
