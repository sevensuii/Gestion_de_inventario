<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use App\Models\Replica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
    public function create(Request $request)
    {
        $objeto = Objeto::find($request->id);
        if (!$objeto) {
            return redirect()->route('departamento.index')->with('error', 'El objeto no existe');
        }
        for ($i = 0; $i < $request->cantidad; $i++) {
            $replica = new Replica();
            $replica->codigo_qr = Str::random(30);
            $replica->objeto = $objeto->id;
            $replica->save();
        }
        return 'ok';
        // return redirect()->route('');
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
        // dd($request->all());
        $replica = Replica::find($request->id);
        $replica->incidencias = $request->incidencia;
        $replica->update();
        // dd($replica);
        // Replica::where(['id_replica', $request->id])->update([
        //     'incidencias' => $request->incidencia,
        // ]);

        return 'ok';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Replica  $replica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Replica $replica)
    {
        $replica = Replica::find($request->id);
        if ($replica)
        {
            $replica->delete();
            return 'ok';
        }
        else
        {
            return 'error';
        }
    }

    public function buscaReplicasPorObjeto(Request $request)
    {
        return DB::select("SELECT r.id_replica , r.codigo_qr , r.incidencias , o.nombre
                            FROM replicas r, objetos o
                            WHERE r.objeto = $request->id and r.objeto = o.id and r.deleted_at is null");
    }
}
