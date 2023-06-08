<?php

namespace App\Http\Controllers;

use App\Tarifa;
use App\Cliente;
use App\Prospecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ClienteController extends Controller
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


    public function index()
    {
        //
        $idUsuario = Auth::user();
        // validar admin
        $rol_id = $idUsuario->rol_id;
        if ($rol_id == 1) {
            $clientes = Cliente::all();
        } else {
            $clientes = Cliente::where('user_id', $idUsuario->id)->get();
        }

        foreach($clientes as $cliente)
        {
            $cliente->nombre = Crypt::decryptString($cliente->nombre);
        }

        return view('clientes.index', compact('idUsuario', 'rol_id', 'clientes'));
    }



    public function contarClientes()
    {
        // se consume con javascript y se muestra en dashboard
        $ajaxMes = [];
        for ($mes = 1; $mes <= 12; $mes++) {
            $clientes = Cliente::whereMonth('created_at', strval($mes))->count();
            $ajaxMes[] = $clientes;
        }
        return $ajaxMes;
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
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
        $this->authorize('view', $cliente);
        $tarifa = Tarifa::where('id', $cliente->id)->pluck('tarifa')->last();
        $cliente->nombre = Crypt::decryptString($cliente->nombre);

        if($cliente->rfc)
        {
            $cliente->rfc = Crypt::decryptString($cliente->rfc);
        }


        if($cliente->direccion)
        {
            $cliente->direccion = Crypt::decryptString($cliente->direccion);
        }
        return view('clientes.show', compact('cliente', 'tarifa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
        $cliente->nombre = Crypt::decryptString($cliente->nombre);

        if($cliente->rfc)
        {
            $cliente->rfc = Crypt::decryptString($cliente->rfc);

        }

        if($cliente->direccion)
        {
            $cliente->direccion = Crypt::decryptString($cliente->direccion);

        }
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
        $this->validate($request,[
            'cliente' => ['required','string', 'min:3'],
            'empresa' => ['required', 'string', 'min:3'],
            'rfc' => ['nullable'],
            'direccion' => ['nullable'],
            'correo' => ['required', 'email', 'min:5'],
            'observaciones' => 'nullable'
        ]);


        $cliente->nombre =Crypt::encryptString( $request['cliente']);
        $cliente->empresa = $request['empresa'];
        $cliente->rfc = Crypt::encryptString($request['rfc']);
        $cliente->direccion = Crypt::encryptString($request['direccion']);
        $cliente->correo = $request['correo'];
        $cliente->observaciones = $request['observaciones'];

        $cliente->save();

        return redirect()->route('clientes.index');

    }

    public function obtenerClientesMes()
    {
        $user = Auth::user()->rol_id;

        if($user == 3)
        {
            return back();
        }
        $ajaxCliente = [];
        $clientes = Cliente::count();

        for ($i = 1; $i <= $clientes; $i++) {
            $clientesMes = Cliente::whereMonth('created_at', date('m'))->count();
            $ajaxCliente[] = $clientesMes;
        }
        return $ajaxCliente;
    }

    public function clientesLabels()
    {
        $user = Auth::user()->rol_id;

        if($user == 3)
        {
            return back();
        }

        $clientes = Cliente::all('nombre');
        $arregloClientes = [];

        foreach($clientes as $cliente)
        {
            $cliente->nombre = Crypt::decryptString($cliente->nombre);

            $arregloClientes[]= $cliente->nombre;
        }

        return $arregloClientes;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //

        $cliente->delete();
    }
}
