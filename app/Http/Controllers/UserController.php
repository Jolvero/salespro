<?php

namespace App\Http\Controllers;

use App\Rol;
use App\User;
use Illuminate\Support\Str;
use App\Events\UserRegister;
use Illuminate\Http\Request;
use App\Events\NuevoProspecto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;

class UserController extends Controller
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

    public function index(User $user)
    {
        $this->authorize('viewAny', $user);
        //
        $usuarios = User::all();
        $roles = DB::table('rols')->get();

        return view('usuarios.index', compact('usuarios', 'roles'));
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
        // modificar request
        $request->request->add(['username' => Str::slug($request->username)]);

        //
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|max:20',
            'email' => 'required|unique:users|max:60',
            'rol_id' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->rol_id = $request['rol_id'];
        $user->password = Hash::make($request['password']);

        $user->save();

         return back()->with('estado', 'Usuario Registrado Correctamente');
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
    public function edit(User $user)
    {
        //
        $this->authorize('create', $user);
        $roles = Rol::all();
        return view('usuarios.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $request->request->add(['username' => Str::slug($request->username)]);
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|max:20',
            'email' => 'required|max:60',
            'rol_id' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $user->name = $request['name'];
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->rol_id = $request['rol_id'];
        $user->password = Hash::make($request['password']);

        $user->save();

        return redirect()->route('usuarios.index')->with('estado', 'Usuario Actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $this->authorize('delete', $user);
        $user->delete();
    }
}
