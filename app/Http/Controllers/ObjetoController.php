<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Objeto;
use App\Models\Replica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;

class ObjetoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $objetos = DB::select("SELECT o.id, o.id_aula , d.id_departamento, o.nombre, concat('P', a.piso, 'A', a.numero) as aula, count(*) as replicas ,d.nombre as departamento, o.descripcion, o.objeto_photo_path
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
        $dep = Auth::user()->trabaja_departamento;
        $aulas = DB::select("SELECT concat('P', a.piso, 'A', a.numero) as nombre, a.id_aula as id
                                from aulas a , departamentos d
                                where d.id_departamento = {$dep} and a.id_departamento = d.id_departamento and a.deleted_at is null
                                order by a.piso , a.numero");
        return view('departamentos.create', compact('aulas'));
    }

    public function randomHash()
    {
        $randomHash = Str::random(30);
        $unique = false;
        while ($unique)
        {
            $objeto = Replica::where('codigo_qr', $randomHash)->first();
            if (!$objeto)
            {
                $unique = true;
            }
            else
            {
                $randomHash = Str::random(30);
            }
        }
        return $randomHash;
    }


    public function getMultipleHash($num)
    {
        $hashArray = [];
        for ($i = 0; $i < $num; $i++)
        {
            $hashArray[] = $this->randomHash();
        }
        return $hashArray;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'replicas' => 'required|integer',
        ]);
        $request->hasFile('foto') ? $fotoURL = $request->file('foto')->store('public/objetos') : $fotoURL = '';
        // {
        //     $fotoURL = $request->foto->store('objetos', 'public');
        // }
        $objeto = Objeto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'hash' => $request->hash,
            'id_aula' => $request->aula,
            'foto' => $fotoURL,
        ]);

        for ($i = 0; $i < $request->replicas; $i++)
        {
            Replica::create([
                'objeto' => $objeto->id,
                'codigo_qr' => $this->randomHash(),
            ]);
        }
        return redirect()->route('midepartamento.edit', $objeto->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Objeto $objeto)
    {
        $objeto = DB::select("SELECT r.codigo_qr , r.incidencias , o.nombre , o.descripcion , o.objeto_photo_path , concat('P', a.piso, 'A', a.numero) as aula , d.nombre as dep
                                from replicas r , objetos o , aulas a , departamentos d
                                where r.objeto = o.id and o.id_aula = a.id_aula and a.id_departamento  = d.id_departamento and r.codigo_qr like '$request->codigo'");

        // dd($objetos);
        return view('objetos.show', compact('objeto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Objeto  $objeto
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Objeto $objeto)
    {
        $dep = Auth::user()->trabaja_departamento;
        $objeto = Objeto::find($request->id);
        $replicas = Replica::where('objeto', $objeto->id)->get();
        $aulas = DB::select("SELECT concat('P', a.piso, 'A', a.numero) as nombre, a.id_aula as id
                                from aulas a , departamentos d
                                where d.id_departamento = {$dep} and a.id_departamento = d.id_departamento and a.deleted_at is null
                                order by a.piso , a.numero");

        return view('departamentos.create', compact('objeto', 'replicas', 'aulas'));
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
        // dd($request->all());
        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'replicas' => 'required|integer',
        ]);

        $arrayUpdate = [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'id_aula' => $request->aula,
        ];

        if ($request->hasFile('foto'))
        {
            $fotoURL = $request->file('foto')->store('objetos', 'public');
            $arrayUpdate['objeto_photo_path'] = $fotoURL;
        };

        Objeto::where('id', $request->item_id)
                ->update($arrayUpdate);
                // dd($request->item_id);

        return redirect()->route('midepartamento.edit', $request->item_id);
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
        return DB::select("SELECT o.nombre , o.descripcion , concat('P', a.piso, 'A', a.numero) as aula, d.nombre as departamento
                            FROM objetos o , aulas a , departamentos d
                            WHERE o.id_aula = a.id_aula and a.id_departamento = d.id_departamento and d.id_departamento = $request->id and o.deleted_at is null");
    }
}
