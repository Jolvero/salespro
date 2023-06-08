@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/registrarUsuario.js') }}" defer></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6 ml-5 ml-md-0">
            <h1>Editar {{ $user->name }}</h1>
            <img src="{{ '/images/usuario.png' }}" class="ml-5" alt="">
        </div>
    </div>
    <form action="{{ route('usuario.update', ['user' => $user->id]) }}" method="POST" id="formulario-usuario">
        @method('PUT')
        @csrf
        <div class="row justify-content-center ml-5 ml-md-0">
            <div class="col-md-6">
                <div class="form-group mt-5">
                    <img src="{{ '/images/nombre.png' }}" alt="" class="mr-1 mb-3">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group mt-5">
                    <img src="{{ '/images/show-prospecto-user.png' }}" alt="" class="mr-1 mb-3">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="{{ $user->username }}"
                        class="form-control @error('username') is-invalid @enderror">

                    @error('username')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <img src="{{ '/images/correo.png' }}" alt="" class="mr-1 mb-3">
                    <label for="email">Correo</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                        class="form-control @error('username') is-invalid @enderror">

                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <img src="{{ '/images/rol.png' }}" alt="" class="mr-1 mb-3">
                    <label for="rol_id">Rol</label>
                    <select name="rol_id" id="rol_id" class="form-control @error('rol_id') is-invalid @enderror">
                        <option value="">-- Seleccione --</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}"{{ $user->rol_id == $rol->id ? 'selected' : '' }}>
                                {{ $rol->rol }}</option>
                        @endforeach
                    </select>

                    @error('rol_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <img src="{{ '/images/lock.png' }}" class="mr-1 mb-3" alt="">
                <label>Ingrese Contraseña</label>
                <div class="input-group">
                    <input id="password" name="password" type="Password"
                        Class="form-control @error('password') is-invalid @enderror">

                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <div class="input-group-append">
                        <button id="show_password" class="btn btn-info" type="button" onclick="mostrarPassword()"> <span
                                class="fa fa-eye-slash icon"></span></button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <img src="{{ '/images/lock.png' }}" class="mr-1 mb-3" alt="">
                    <label for="password_confirmation">Confirmar <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" id="password_confirmation">

                    @error('password_confirmation')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-dark mt-5 text-white" id="btn-enviar"><img
                    src="{{ '/images/agregar-archivo.png' }}" width="64px" alt="">Editar</button>
    </form>
    </div>
@endsection
