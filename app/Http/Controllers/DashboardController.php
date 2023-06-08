<?php

namespace App\Http\Controllers;

use App\User;
use App\Cliente;
use App\Prospecto;
use App\Recordatorio;
use App\Events\UserRegister;
use Illuminate\Http\Request;

use App\Events\NuevoProspecto;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotificationRecordatorios;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function prospectosUsuario()
    {
        $mes = date('m');
        $prospectadores = User::where('rol_id', 2)->get();
        $ajaxProspectosUser = [];


        foreach($prospectadores as $prospectador)
        {
            $prospectos = Prospecto::whereMonth('created_at', $mes)->where('user_id', $prospectador->id)->count();
            $ajaxProspectosUser[] =$prospectos;
        }

        return $ajaxProspectosUser;

    }

    // prospectadores labels grafica pastel
    public function contar()
    {
        $prospectadores = User::where('rol_id', 2)->get('name');
        $arregloProspectadores = [];

        foreach($prospectadores as $prospectador)
        {
            $arregloProspectadores[] = $prospectador->name;
        }

        return $arregloProspectadores;
    }



    public function index()
    {

        // obtener los clientes del usuario
        $usuario = Auth::id();
        $nombre = Auth::user()->name;

        // notificacion
        $recordatorios = Recordatorio::where('user_id',$usuario)->where('read', null)->get(['fecha_recordatorio', 'asunto', 'id', 'user_id']);
        foreach($recordatorios as $recordatorio)
        {
            $fechaActual = date('Y-m-d');
            if($recordatorio['fecha_recordatorio'] == $fechaActual)
            {
                $asunto = $recordatorio['asunto'];
                $recordatorio->user->notify(new NotificationRecordatorios($recordatorio->fecha_recordatorio, $recordatorio['id'], $nombre, $asunto, $recordatorio->user_id));
            }
            $recordatorios->toQuery()->update(['read' => $fechaActual]);
        }
        $clientes = Cliente::count();
        $prospectadores = User::where('rol_id', 2)->count();


        return view('dashboard.index', compact('usuario', 'nombre', 'clientes', 'recordatorios', 'prospectadores'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
