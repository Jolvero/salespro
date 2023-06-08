<?php

namespace App\Http\Controllers;

use App\Prospecto;
use App\Recordatorio;
use Facade\FlareClient\Glows\Recorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordatorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('auth');
     }


    public function index()
    {
        //
        $idUsuario = Auth::id();
        $recordatorios = Recordatorio::where('user_id', $idUsuario)->get();
        $prospectos = Prospecto::whereUser_id($idUsuario)->get();

        return view('recordatorios.index', compact('idUsuario', 'recordatorios', 'prospectos'));
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
        $data = $request->validate([
            'asunto' => 'required|string|min:4',
            'fecha' => 'required|date',
            'fecha_recordatorio' => 'required|date',
            'prospecto_id' => 'required',
        ]);
        $fecha_recordatorio = str_replace('T', ' ', $request['fecha_recordatorio']);
        $idUsuario = Auth::id();
        $recordatorio = new Recordatorio($data);
        $recordatorio->fecha_recordatorio = $fecha_recordatorio;
        $recordatorio->user_id = $idUsuario;
        $recordatorio->save();

        return redirect()->action('RecordatorioController@index')->with('estado', 'Recordatorio generado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recordatorio  $recordatorio
     * @return \Illuminate\Http\Response
     */
    public function show(Recordatorio $recordatorio)
    {
        //
        $this->authorize('viewAny', $recordatorio);
        return view('recordatorios.show', compact('recordatorio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recordatorio  $recordatorio
     * @return \Illuminate\Http\Response
     */
    public function edit(Recordatorio $recordatorio)
    {
        //
        $this->authorize('edit', $recordatorio);
        $prospectos = Prospecto::where('user_id', $recordatorio->user_id)->get();
        return view('recordatorios.edit', compact('recordatorio', 'prospectos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recordatorio  $recordatorio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recordatorio $recordatorio)
    {
        //
        $this->validate($request, [
            'asunto' => 'required|string|min:4',
            'fecha' => 'required|date',
            'fecha_recordatorio' => 'required|date',
            'prospecto_id' => 'required'

        ]);
        $recordatorio->asunto = $request['asunto'];
        $recordatorio->fecha = $request['fecha'];
        $recordatorio->fecha_recordatorio = $request['fecha_recordatorio'];
        $recordatorio->prospecto_id = $request['prospecto_id'];
        $recordatorio->save();

        return redirect()->route('recordatorio.index')->with('estado', 'Recordatorio actualizado');

    }

    public function aviso($fecha)
    {
        $recordatorios = Recordatorio::where('fecha_recordatorio', $fecha)->get();

        foreach($recordatorios as $recordatorio)
        {
            $recordatorio->prospecto_id = $recordatorio->Prospecto;
        }

       if($recordatorios->count() > 0)
       {
         $recordatorios->toQuery()->update([
            'read' => 'check'
        ]);
       }
       return $recordatorios;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recordatorio  $recordatorio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recordatorio $recordatorio)
    {
        //
         Recordatorio::whereId($recordatorio->id)->delete();
    }
}
