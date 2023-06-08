<?php

namespace App\Http\Controllers;

use App\Plantilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlantillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $plantillas = Plantilla::where('user_id', Auth::id())->get();
        return view('plantillas.index', compact('plantillas'));
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
        $this->validate($request, [
            'nombre' => 'required|string',
            'plantilla' => 'required|min:10|max:10000'
        ]);

        $idUsuario = Auth::id();
        $plantilla = new Plantilla();
        $plantilla->nombre = $request['nombre'];
        $plantilla->plantilla = $request['plantilla'];
        $plantilla->user_id = $idUsuario;

        $plantilla->save();

        return back()->with('plantilla', 'Plantilla guardada correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function show(Plantilla $plantilla)
    {
        //
        return view('plantillas.show', compact('plantilla'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function edit(Plantilla $plantilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plantilla $plantilla)
    {
        //
    }

    public function actualizarPlantilla($id, $plantilla)
    {
        Plantilla::whereId($id)->update([
            'plantilla' => $plantilla
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plantilla  $plantilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plantilla $plantilla)
    {
        //
        $plantilla->delete();
    }
}
