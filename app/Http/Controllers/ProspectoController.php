<?php

namespace App\Http\Controllers;

use App\User;
use App\Estado;
use App\Tarifa;
use App\Cliente;
use App\Servicio;
use App\Plantilla;
use App\Prospecto;
use App\Comentario;
use App\Cotizacion;
use App\File;
use App\Jobs\CorreoProspecto as JobsCorreoProspecto;
use App\Recordatorio;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Mail\CorreoProspecto;
use App\Mail\Mailing;
use App\Mail\Prueba;
use App\Notifications\ClienteNotificacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Notifications\ProspectoNotificacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class ProspectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        return $this->middleware('auth');
     }
    public function index(Prospecto $prospecto)
    {
        $this->authorize('viewAny', $prospecto);
        //
        $id = Auth::id();
        $rol = Auth::user()->rol_id;
        $estados = Estado::all();
        $servicios = Servicio::all();

        // admin puede ver todos los prospectos
        if ($rol == 1) {
            $prospectos = Prospecto::all();
        } else {
            $prospectos = Prospecto::where('user_id', $id)->where('estado_id', 1)->get();
        }

        return view('prospectos.index', compact('id', 'prospectos', 'estados', 'servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function notificar()
    {
        // notifica a direccion sobre los nuevos prospectos registrados
        $notificaciones = auth()->user()->unreadNotifications;

        auth()->user()->unreadNotifications->markAsRead();

        return view('notificaciones.prospecto', [
            'notificaciones' => $notificaciones
        ]);
    }

    public function notificacionProspectoCliente()
    {
        // notifica a direccion sobre los nuevos clientes registrados
        $notificaciones = auth()->user()->unreadNotifications;

        auth()->user()->unreadNotifications->markAsRead();

        return view('notificaciones.clientes', [
            'notificaciones' => $notificaciones
        ]);
    }

    public function autorizarTarifa($id)
    {
        // se consume con javascript
        return Tarifa::where('id', $id)->update([
            'estatus_id' => 2
        ]);
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
        $user_id = Auth::id();
        $data = $request->validate([
            'nombre' => 'required|string',
            'empresa' => 'required|string',
            'servicio_id' => 'required',
            'correo' => 'required|string',
            'cotizacion_id' => 'nullable',
            'observaciones' => 'nullable'
        ]);

        $cliente_uuid = Uuid::uuid4();
        $comentario_uuid = Uuid::uuid4();
        // cotizaciones y prospectos se relacionan con uuid
        $cotizaciones = $request->file('cotizacion_id');
        if ($request->hasFile('cotizacion_id')) {
            $uuid_cotizacion = Uuid::uuid4();

            foreach ($cotizaciones as $cotizacion) {
                $tamañoArchivo = filesize($cotizacion);
                // validar tamaño menor a 20 m
                if ($tamañoArchivo > 20000000) {
                    return back()->with('tamaño', 'Las cotizaciones no pueden pesar mas de 20 M');
                }
                $nombre = $cotizacion->getClientOriginalName();
                $nombre = preg_replace('/[+\;\(\)\/\ \#\|\|\" "]+/', '-', $nombre);

                Storage::putFileAs(
                    '/public/documentos/' . $request['empresa'] . '/',
                    $cotizacion,
                    $nombre
                );
                $cotizacion = new Cotizacion();
                $cotizacion->nombre = $nombre;
                $cotizacion->cotizacion_uuid = $uuid_cotizacion;
                $cotizacion->save();
            }
        }
        $validarCotizacion = isset($uuid_cotizacion);
        $prospecto = new Prospecto($data);

        $prospecto->user_id = $user_id;
        $prospecto->cliente_uuid = $cliente_uuid;
        $prospecto->comentario_id = $comentario_uuid;
        if ($validarCotizacion == true) {
            $prospecto->cotizacion_id = $uuid_cotizacion;
        }

        // inicio historial de comentarios
        if($data['observaciones'] != null)
        {
            $comentario = new Comentario();
            $comentario->prospecto_id = $comentario_uuid;
            $comentario->comentario = $data['observaciones'];

            $comentario->save();
        }
        $prospecto->save();

        // enviar notificacion a usuario admin
        $userMaster = User::where('email', 'direccionoperaciones@mrollogistics.com.mx')->get();
        Notification::send($userMaster, new ProspectoNotificacion($prospecto->id, $prospecto->nombre, $prospecto->empresa, $prospecto->correo, $prospecto->cotizacion_id, $prospecto->observaciones, 'Prospecto', $user_id, '/prospecto/'. $prospecto->id. '/show'));

        return back()->with('estado', 'Prospecto agregado');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function show(Prospecto $prospecto)
    {
        //
        $this->authorize('view', $prospecto);
        // tarifas de prospecto
        $tarifas = Tarifa::where('id', $prospecto->tarifa_id)->get();
        $cotizaciones = Cotizacion::where('cotizacion_uuid', $prospecto->cotizacion_id)->get();
        $comentarios = Comentario::where('prospecto_id', $prospecto->comentario_id)->orderBy('id', 'desc')->get();
        $plantillas = Plantilla::where('user_id', Auth::id())->get();
        return view('prospectos.show', compact('prospecto', 'cotizaciones', 'tarifas', 'comentarios', 'plantillas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function edit(Prospecto $prospecto)
    {
        //
        $this->authorize('edit', $prospecto);
        $tarifa = Tarifa::where('id', $prospecto->tarifa_id)->pluck('tarifa')->last();
        $tarifa_prospecto = Tarifa::where('id', $prospecto->tarifa_id)->pluck('estatus_id')->last();
        $estados = Estado::all();
        $servicios = Servicio::all();
        return view('prospectos.edit', compact('prospecto', 'estados', 'tarifa','tarifa_prospecto', 'servicios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prospecto $prospecto)
    {
        //
        $user_id = Auth::id();
        $data = $request->validate([
            'nombre' => 'required|string',
            'estado_id' => 'required|integer',
            'empresa' => 'required|string',
            'servicio_id' => 'required',
            'correo' => 'required|string',
            'cotizacion_id' => 'nullable',
            'tarifa' => 'nullable',
            'observaciones' => 'nullable'
        ]);

        $cotizaciones = $request->file('cotizacion_id');
        if ($request->hasFile('cotizacion_id')) {
            $uuid_cotizacion = $prospecto->cotizacion_id;
            if ($uuid_cotizacion == null) {
                $uuid_cotizacion = Uuid::uuid4();
            }
            foreach ($cotizaciones as $cotizacion) {
                $tamañoArchivo = filesize($cotizacion);
                if ($tamañoArchivo > 20000000) {
                    return back()->with('tamaño', 'Las cotizaciones no pueden pesar mas de 20 M');
                }
                $nombre = $cotizacion->getClientOriginalName();
                $nombre = preg_replace('/[+\;\(\)\/\ \#\|\|\" "]+/', '-', $nombre);

                Storage::putFileAs(
                    '/public/documentos/' . $request['empresa'] . '/',
                    $cotizacion,
                    $nombre
                );
                $cotizacion = new Cotizacion();
                $cotizacion->nombre = $nombre;
                $cotizacion->cotizacion_uuid = $uuid_cotizacion;
                $cotizacion->save();
            }
        }

        // validar tarifa
        $validarTarifa = Tarifa::where('id', $prospecto->tarifa_id)->get();

        $validarEstatus = $validarTarifa->pluck('estatus_id')->last();
        // valida si existe data[tarifa] si es false ya actualizo anteriormente la tarifa y esta en espera de autorizacion
        if($validarEstatus == '1' && isset($data['tarifa']) == true)
        {
            $actualizarTarifa = Tarifa::where('id', $prospecto->tarifa_id);
            $actualizarTarifa->update(['tarifa' => $data['tarifa']]);
        }
        // se inserta por primera vez la tarifa
        if ($validarTarifa->count() == 0 && $data['tarifa'] != null)
        {
            $tarifa = new Tarifa();
            $tarifa->tarifa = $data['tarifa'];
            $tarifa->estatus_id = 1;
            $tarifa->save();

            $prospecto->tarifa_id = $tarifa->id;
        }

        if($validarEstatus == 2 && Auth::user()->rol_id == 1)
        {
            $actualizarTarifa = Tarifa::where('id', $prospecto->tarifa_id);
            $actualizarTarifa->update(['tarifa' => $data['tarifa']]);
        }
        // actualizar prospecto
        $prospecto->nombre = $data['nombre'];
        $prospecto->estado_id = $data['estado_id'];
        $prospecto->empresa = $data['empresa'];
        $prospecto->servicio_id = $data['servicio_id'];
        $prospecto->correo = $data['correo'];
        $prospecto->user_id = $user_id;
        $validarCotizacion = isset($uuid_cotizacion);
        if ($validarCotizacion == true) {
            $prospecto->cotizacion_id = $uuid_cotizacion;
        }

        //continua historial de comentarios
        if($data['observaciones'] !=null)
        {
            $comentario = new Comentario();
            $comentario->comentario = $data['observaciones'];
            $comentario->prospecto_id = $prospecto->comentario_id;

            $comentario->save();
        }

        // si es cliente se quita de prospectos y se pasa a su cartera de clientes
        if ($prospecto->estado_id == 2) {
            if($prospecto->tarifa_id == null)
            {
                return back()->with('estado', 'Debes agregar una tarifa');
            }

            if($prospecto->tarifa->estatus_id == '1')
            {
                return back()->with('estado', 'La tarifa debe estar autorizada');
            }

            $clienteNuevo = new Cliente();
            $clienteNuevo->nombre = Crypt::encryptString($prospecto->nombre);
            $clienteNuevo->empresa = $prospecto->empresa;
            $clienteNuevo->correo = $prospecto->correo;
            $clienteNuevo->tarifa_id = $prospecto->tarifa_id;
            $clienteNuevo->observaciones = $prospecto->observaciones;
            $clienteNuevo->user_id = Auth::id();
            $clienteNuevo->uuid = $prospecto->cliente_uuid;
            $clienteNuevo->save();

            $recordatorio = Recordatorio::where('prospecto_id', $prospecto->id);

            if($recordatorio->count()>0)
            {
                $recordatorio->delete();

            }
            $prospecto->delete();

            $userMaster = User::where('email', 'direccionoperaciones@mrollogistics.com.mx')->get();

            Notification::send($userMaster, new ClienteNotificacion($clienteNuevo->id, $clienteNuevo->nombre, $clienteNuevo->empresa, $clienteNuevo->correo, $clienteNuevo->tarifa_id, $clienteNuevo->observaciones, $user_id, 'Cliente'));

            return redirect()->action('ProspectoController@index')->with('estado', 'Prospecto cambiado a tus clientes');
        }

        $prospecto->correo = $data['correo'];
        $prospecto->save();


        // si se descarta(3) se elimina el prospecto
        if($prospecto->estado_id == 3)
        {
            $recordatorio = Recordatorio::where('prospecto_id', $prospecto->id);

            if($recordatorio->count()>0)
            {
                $recordatorio->delete();

            }
            $prospecto->delete();
            return redirect()->action('ProspectoController@index')->with('estado', 'Prospecto Eliminado');

        }

        if($prospecto->estado_id == 1 || $prospecto->estado_id == 2)
        {
            $userMaster = User::where('email', 'Fiones@mrollogistics.com.mx')->get();
            Notification::send($userMaster, new ProspectoNotificacion($prospecto->id, $prospecto->nombre, $prospecto->empresa, $prospecto->correo, $prospecto->cotizacion_id, $prospecto->observaciones, 'Prospecto', $user_id, '/prospecto/'. $prospecto->id. '/show'));
        }

        return redirect()->action('ProspectoController@index')->with('estado', 'Prospecto actualizado');

    }

    public function obtenerProspectosMes()
    {
        $user = Auth::user()->rol_id;

        if($user == 3)
        {
            return back();
        }
        $ajaxProspecto = [];
        $prospectos = Prospecto::count();

        for ($i = 1; $i <= 12; $i++) {
            $prospectoMes = Prospecto::whereMonth('created_at', $i)->count();
            $ajaxProspecto[] = $prospectoMes;
        }
        return $ajaxProspecto;
    }

    public function prospectosLabels()
    {
        $prospectos = Prospecto::all('nombre');
        $arregloProspectos = [];

        foreach($prospectos as $prospecto)
        {

            $arregloProspectos[]= $prospecto->nombre;
        }

        return $arregloProspectos;
    }


    public function mailing()
    {
        $idUsuario = Auth::id();
        $plantillas = Plantilla::where('user_id', $idUsuario)->get(['nombre', 'plantilla']);

        $prospectos = Prospecto::where('user_id', $idUsuario)->get(['nombre', 'empresa', 'correo']);

        return view('correos.mailing', compact('plantillas', 'prospectos'));
    }

    public function correoPrueba()
    {
       JobsCorreoProspecto::dispatch();

    }

    public function mailingStore(Request $request, Auth $user)
    {
        $this->validate($request, [
            'plantilla-seleccionada' => 'required|string|min:10|max:500'
        ]);
        $mensaje = $request['plantilla-seleccionada'];
        $adjuntos = [];
        if($request->hasFile('info'))
        {
            $files = $request->file('info');
            $carpeta = 'infos';
            foreach ($_FILES['info']['size'] as $file) {
                if ($file > 20000000) {
                    return back()->with('estado', 'No pueden agregarse archivos mayores a 20 mb');
                }

            }

            foreach ($files as $file) {
                $nombre = $file->getClientOriginalName();
                $nombre = preg_replace('/[+\;\(\)\/\ \#\|\|\" "]+/', '-', $nombre);
                Storage::putFileAs('/public/' . $carpeta . '/', $file, $nombre);
                $adjuntos[] = $nombre;
            }


        }

        if($request['correos'])
        {
            $correos = explode("\n", $request['correos']);
            $end = end($correos);
            foreach($correos as $correo)
            {
                if($correo != $end)
                {
                    $correo = substr($correo, 0, -1);
                }
                Mail::to($correo)->bcc('sistemas@mrollogistics.com.mx')->send(new Mailing($mensaje, $adjuntos, $user));
            }
        }

        return back()->with('success', 'Correos enviados exitosamente');
}
    public function tipoClienteProspecto($tipo)
    {
        if($tipo == 'clientes')
        {
            $seleccionarInformacion = DB::table('clientes')->where('user_id', Auth::id())->get(['nombre', 'empresa', 'correo']);

            foreach($seleccionarInformacion as $dato)
            {
                $dato->nombre = Crypt::decryptString($dato->nombre);
            }

        }
        else
        {
            $seleccionarInformacion = DB::table('prospectos')->where('user_id', Auth::id())->get(['nombre', 'empresa', 'correo', 'servicio_id']);
        }
        return $seleccionarInformacion;
    }

    public function enviarCorreo(Request $request, Auth $user)
    {
        // en la vista show se envia el correo y se ejecuta la funcion
        $data = $request->validate([
            'destinatario' => 'required|email',
            'asunto' => 'required|string',
            'mensaje' => 'required',
        ]);
        $agruparAdjuntos = [];
        $prospecto = Prospecto::where('nombre', $request['nombre-prospecto'])->pluck('nombre')->last();

        $adjuntos = $request->file('adjunto');
        if ($request->hasFile('adjunto')) {
            foreach ($adjuntos as $adjunto) {
                $tamañoArchivo = filesize($adjunto);
                if ($tamañoArchivo > 10000000) {
                    return back()->with('tamaño', 'Los adjuntos no pueden pesar mas de 10 M');
                }
                $nombre = $adjunto->getClientOriginalName();
                $nombre = preg_replace('/[+\;\(\)\/\ \#\|\|\" "]+/', '-', $nombre);

                Storage::putFileAs('/public/correos/' . $prospecto . '/', $adjunto, $nombre);
                $agruparAdjuntos[] = public_path('storage/correos/' . $prospecto . '/' . $nombre);
            }

        }
        Mail::to($request['destinatario'])->send(new CorreoProspecto($request['mensaje'], $user, $request['asunto'], $agruparAdjuntos));

            return back()->with('correo', 'Correo enviado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prospecto  $prospecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prospecto $prospecto)
    {
        //
        $recordatorio = Recordatorio::where('prospecto_id', $prospecto->id);

            if($recordatorio->count()>0)
            {
                $recordatorio->delete();

            }
        $prospecto->delete();
    }
}
