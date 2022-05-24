<?php

namespace App\Http\Controllers;

use App\Models\Replica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReplicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Replica  $replica
     * @return \Illuminate\Http\Response
     */
    public function show(Replica $replica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Replica  $replica
     * @return \Illuminate\Http\Response
     */
    public function edit(Replica $replica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Replica  $replica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Replica $replica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Replica  $replica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Replica $replica)
    {
        //
    }

    public function buscaReplicasPorObjeto(Request $request)
    {
        return DB::select("SELECT r.id_replica , r.codigo_qr , r.incidencias , o.nombre
                            FROM replicas r, objetos o
                            WHERE r.objeto = $request->id and r.objeto = o.id");
    }
}
