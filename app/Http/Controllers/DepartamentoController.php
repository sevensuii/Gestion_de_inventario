<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamento = Departamento::all()->where('id_departamento', Auth::user()->trabaja_departamento)->first();
        // $objetos = DB::select("select a.id_aula, o.nombre , o.descripcion , concat('A', a.numero, 'P', a.piso) as aula, d.nombre as departamento
        //                             from objetos o , aulas a , departamentos d
        //                             where o.id_aula = a.id_aula and a.id_departamento = d.id_departamento and d.id_departamento = $departamento->id_departamento");
        $objetos = DB::select("SELECT o.id, o.id_aula, o.nombre, concat('A', a.numero, 'P', a.piso) as aula, count(*) as replicas ,d.nombre as departamento, o.descripcion
                                FROM objetos o, aulas a, departamentos d , replicas r
                                WHERE o.id_aula = a.id_aula and a.id_departamento = d.id_departamento and r.objeto = o.id and d.id_departamento = $departamento->id_departamento
                                GROUP BY o.id, o.id_aula , d.id_departamento, o.nombre , d.nombre , o.descripcion , aula");

        // $replicas = DB::select("SELECT r.id_replica , r.codigo_qr , r.incidencias , r.objeto
        //                         FROM replicas r, objetos o, aulas a, departamentos d
        //                         WHERE r.objeto = o.id and o.id_aula = a.id_aula and a.id_departamento = d.id_departamento
        //                             and d.id_departamento = $departamento->id_departamento;");

        return view('departamentos.index', compact('departamento', 'objetos'));
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
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        //
    }
}
