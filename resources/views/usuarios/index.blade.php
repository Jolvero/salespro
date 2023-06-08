@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/tables.js') }}" defer></script>
    <script src="{{ asset('js/alertas.js') }}" defer></script>
    <script src="{{ asset('js/registrarUsuario.js') }}" defer></script>
    <script src="{{ asset('js/eliminarUsuario.js') }}" defer></script>
@endsection
@section('content')
    @if (session('estado'))
        <div class="alert alert-success text-center">
            {{ session('estado') }}
        </div>
    @endif

    <!-- modal -->
    <div class="modal fade" id="agregar-usuario" tabindex="-1" data-backdrop="static" aria-hidden="true"
        aria-labelledby="agregar-usuarioLabel" data-keyboard="false" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2><img src="{{ '/images/usuario.png' }}" alt="img-usuario-header" class="mr-2" width="50px">Nuevo
                        Usuario</h2>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuario.agregar') }}" method="POST" novalidate id="formulario-usuario"
                        name="formulario-usuario">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ '/images/nombre.png' }}" alt="" class="mr-1 mb-3">
                                    <label for="name">Nombre <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" name="name" id="name">

                                    @error('name')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ '/images/show-prospecto-user.png' }}" class="mr-1 mb-3" alt="">
                                    <label for="username">Username <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        value="{{ old('username') }}" name="username" id="username">

                                    @error('username')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ '/images/correo.png' }}" class="mr-1 mb-3" alt="">
                                    <label for="email">Correo <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email">

                                    @error('email')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ '/images/rol.png' }}" class="mr-1 mb-3" alt="">
                                    <label for="rol_id">Rol <span class="text-danger">*</span></label>
                                    <select name="rol_id" id="rol_id"
                                        class="form-control @error('rol_id') is-invalid @enderror">
                                        <option value="">-- Seleccione --</option>
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->id }}"
                                                {{ old('rol_id') == $rol->id ? 'selected' : '' }}>{{ $rol->rol }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('rol_id')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ '/images/lock.png' }}" class="mr-1 mb-3" alt="">
                                    <label for="password">Contraseña <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password">
                                    @error('password')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{ '/images/lock.png' }}" class="mr-1 mb-3" alt="">
                                    <label for="password_confirmation">Confirmar <span class="text-danger">*</span></label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" id="password_confirmation">

                                    @error('password_confirmation')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-dark mt-2 text-white" id="btn-enviar"><img
                                    src="{{ '/images/agregar-archivo.png' }}" width="64px" alt="">
                                Agregar</button>

                            <button type="button" class="btn btn-primary mt-2 ml-4" data-dismiss="modal"><img
                                    src="{{ '/images/cerrar.png' }}" alt=""> Cancelar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <h1 class="font-weight-bold ml-5 ml-md-0" data-aos="fade-down" data-aos-duration="1000"> Usuarios</h1>
    <div class="row justify-content-between">
        <div class="col-md-6" data-aos="fade-up" data-aos-duration="1000">
            <img src="{{ '/images/usuario.png' }}" class="ml-5 ml-md-0" alt="">
        </div>
        <div class="col-md-6" data-aos="flip-left" data-aos-duration="1000">
            <img src="{{ '/images/agregar-usuario.png' }}" class="ml-5 ml-md-0 mt-5 mt-md-0 agregar-prospecto"
                alt="" data-target="#agregar-usuario" data-toggle="modal">
            <p class="mx-5 mx-md-2 mt-2">Agregar Usuario</p>
        </div>
    </div>

    <div class="container mt-5">
        <table class="table w-100 ml-5 ml-md-0 display responsive nowrap" id="table">
            <thead>
                <tr data-aos="fade-down" data-aos-duration="1000">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="acciones">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr class="text-center" data-aos="fade-down" data-aos-duration="1000">
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->rol->rol }}</td>
                        <td class="acciones">
                            <a href="{{ route('usuario.editar', ['user' => $usuario->id]) }}"
                                class="btn btn-dark my-2 d-block"><img src="{{ '/images/editar.png' }}"
                                    alt=""></a>

                            <form method="POST" id="eliminar-usuario" name="eliminar-usuario">
                                @csrf
                                @method('DELETE') <button id="{{ $usuario->id }}" data-toggle="tooltip"
                                    data-placement="top" title="Eliminar Usuario"
                                    onclick="eliminarUsuario({{ $usuario->id }});" type="button"
                                    class="btn btn-dark btn-eliminar my-2 d-block w-100"><img
                                        src="{{ '/images/eliminar.png' }}"></button>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
