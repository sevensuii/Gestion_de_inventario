<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Objeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetos = DB::select("SELECT o.id, o.id_aula , d.id_departamento, o.nombre, concat('A', a.numero, 'P', a.piso) as aula, count(*) as replicas ,d.nombre as departamento, o.descripcion
                                        FROM objetos o, aulas a, departamentos d , replicas r
                                        WHERE o.id_aula = a.id_aula and a.id_departamento = d.id_departamento and r.objeto = o.id and o.deleted_at is null
                                        GROUP BY o.id, o.id_aula , d.id_departamento, o.nombre , d.nombre , o.descripcion , aula");

        return view('objetos.index', compact('objetos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function show(Objeto $objeto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function edit(Objeto $objeto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objeto $objeto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Objeto $objeto)
    {
        $objeto = Objeto::find($request->id);

        if ($objeto)
        {
            $objeto->delete();
            return 'ok';
        }
        else
        {
            return 'error';
        }

    }

    public function buscaItemsAula(Request $request)
    {
        // $objetosAula = Objeto::all()->where('id_aula', $request->id);
        // dd($objetosAula);
        // return Objeto::all();
        // $objetosAula = DB::select("SELECT *
        //                             FROM objetos o
        //                             WHERE o.id_aula = $request->id");
        // return $objetosAula;
        // return json_encode(Objeto::all()->where('id_aula', $request->id));
        return Objeto::all()->where('id_aula', $request->id);
    }

    public function buscaItemsDepartamento(Request $request)
    {
        return DB::select("SELECT o.nombre , o.descripcion , concat('A', a.numero, 'P', a.piso) as aula, d.nombre as departamento
                            FROM objetos o , aulas a , departamentos d
                            WHERE o.id_aula = a.id_aula and a.id_departamento = d.id_departamento and d.id_departamento = $request->id and o.deleted_at is null");
    }
}
